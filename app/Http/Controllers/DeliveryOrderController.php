<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use App\Dealer;
use App\Account;
use App\Deposit;
use App\Product;
use App\Purchase;
use App\OrderDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class DeliveryOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.do.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companys = Dealer::select('id', 'company_name')->get();
        $models = Product::select('id', 'model')->groupBy('model')->get();
        return view('pages.do.create', ['models' => $models, 'companys' => $companys]);
    }

    public function search_company_details($id)
    {
        $company = Dealer::select('id', 'company_name', 'dealer_code', 'address', 'phone')->findOrFail($id);
        return response()->json(['company' => $company], 200);
    }

    public function search_product_size($id)
    {
        $model = Product::select('model')->where('id', $id)->first();
        $sizes = Product::select('id', 'model', 'size')->where('model', '=', $model->model)->get();
        return response()->json(['sizes' => $sizes], 200);
    }

    public function search_product_price($id)
    {
        $price = Product::select('id', 'price', 'discount', 'net_price')->where('id', '=', $id)->first();
        return response()->json(['price' => $price], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'company_name' => 'required'
        ], [
            'company_name.required' => 'Select a company name.'
        ]);

        $order = new Order();

        if ($request->has('company_name')) {
            $companyId = $request->input('company_name');
            if ($companyId == 'new_company') {
                $company = $request->input('new_company_name');
                $address = $request->input('address');
                $phone = $request->input('phone');
                $order->dealer_id = DeliveryOrderController::createNewDealer($company, $address, $phone);
            } else {
                $order->dealer_id = $companyId;
            }
        }

        $order->sr_id = Auth::user()->id;

        $order->order_number = uniqid();

        if ($request->has('remark')) {
            $order->remark = $request->input('remark');
        }

        $order->created_at = date('Y-m-d');
        $saveOrder = $order->save();

        if ($saveOrder) {
            // Code for Insert Order Details
            if (!empty(array_filter($request->model))) {
                $size = $request->input('size');
                $quantity = $request->input('quantity');
                $price = $request->input('price');
                $amount = $request->input('amount');

                $i = 0;
                foreach ($request->model as $mod) {
                    if ($mod != null) {
                        $modelInfo = NULL;
                        $modelInfo = array(
                            'order_id' => $order->id,
                            'product_id' => $size[$i],
                            'price' => $price[$i],
                            'quantity' => $quantity[$i],
                            'total' => $amount[$i],
                            'created_at' => date('Y-m-d')
                        );
                        $saveOrderDetail = OrderDetail::create($modelInfo);
                        $i++;
                    }
                }
            }

            // Code for Insert Purchase Details
            $purchase = new Purchase();
            $srId = Auth::user();
            if (!is_null($srId->parent_id)) {
                $dsmId = User::select('id', 'parent_id')->where('id', '=', $srId->parent_id)->first();
                if ($dsmId) {
                    $purchase->dsm_id = $dsmId->id;
                    $dsmParent = $dsmId->parent_id;
                    if (!is_null($dsmParent)) {
                        $sdsmId = User::select('id')->where('id', '=', $dsmParent)->first();
                        $purchase->sdsm_id = $sdsmId->id;
                    }
                }
            }

            if ($srId) {
                $purchase->sr_id = $srId->id;
            }

            $purchase->dealer_id = $order->dealer_id;
            $purchase->order_id = $order->id;

            if (!is_null('total')) {
                $purchase->total_amount = $request->input('total');
            }

            if (!is_null('discount')) {
                $purchase->discount = $request->input('discount');
            }

            if (!is_null('net_total')) {
                $purchase->net_amount = $request->input('net_total');
            }

            $purchase->created_at = date('Y-m-d');

            $savePurchase = $purchase->save();

            if (!$savePurchase) {
            }
            Toastr::success('Order details has saved.', 'success');
            return redirect()->route('order.payment.detail', $order->id);
        } else {
            Toastr::error('W00ps! Something went wrong. Try again.', 'error');
            return redirect()->back();
        }
    }

    /**
     * Display the payment detail add page.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function payment_detail($id)
    {
        $order = Order::select('id', 'dealer_id')->findOrFail($id);
        $dealer = Dealer::select('id', 'company_name')->findOrFail($order->dealer_id);
        return view('pages.do.payment-detail', ['dealer' => $dealer, 'order' => $order]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function payment_detail_store(Request $request)
    {
        if ($request->has('amount') && !is_null($request->amount)) {

            $deposit = new Deposit();

            if ($request->has('company_name')) {
                $slug = Str::slug($request->input('company_name'), '_');
            }

            if ($request->has('dealer_id')) {
                $dealerId = $request->input('dealer_id');
                $deposit->dealer_id = $dealerId;
            }

            // Code for Insert Entity Logo
            if ($request->has('image')) {
                $image = $request->file('image');
                $newImageName = $slug . "_" . $dealerId . "_" . date('m-d-Y_hia') . '.' . $image->getClientOriginalExtension();
                $destinationPath = 'assets/images/uploads';
                $image->move($destinationPath, $newImageName);
                $deposit->image = $newImageName;
            }

            $deposit->amount = $request->input('amount');

            if ($request->has('date')) {
                $deposit->deposit_date = $request->input('date');
            }

            $deposit->created_at = date('Y-m-d');
            $saveDeposit = $deposit->save();
            if ($saveDeposit) {
                $orderId = $request->input('order_id');
                $purchase = Purchase::where('dealer_id', $dealerId)->where('order_id', $orderId)->first();
                $purchase->paid_amount = $deposit->amount;
                $purchase->save();

                $accountUpdate = DeliveryOrderController::updateAccount($deposit->dealer_id);

                Toastr::success('Order and payment details has saved.', 'success');
                return redirect()->route('delivery.order.create');
            } else {
                Toastr::error('W00ps! Something went wrong. Try again.', 'error');
                return redirect()->back();
            }
        } else {
            $dealerId = $request->input('dealer_id');
            $accountUpdate = DeliveryOrderController::updateAccount($dealerId);
            Toastr::success('Order has saved without payment details.', 'success');
            return redirect()->route('delivery.order.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private static function createNewDealer($company, $address, $phone)
    {
        $dealer = new Dealer();

        $srId = Auth::user();
        if (!is_null($srId->parent_id)) {
            $dsmId = User::select('id', 'parent_id')->where('id', '=', $srId->parent_id)->first();
            if ($dsmId) {
                $dealer->dsm_id = $dsmId->id;
                $dsmParent = $dsmId->parent_id;
                if (!is_null($dsmParent)) {
                    $sdsmId = User::select('id')->where('id', '=', $dsmParent)->first();
                    $dealer->sdsm_id = $sdsmId->id;
                }
            }
        }

        if ($srId) {
            $dealer->sr_id = $srId->id;
        }

        $dealer->company_name = $company;

        $dealer->address = $address;

        $dealer->phone = $phone;

        $dealer->created_at = date('Y-m-d');

        $saveDealer = $dealer->save();

        if ($saveDealer) {
            return $dealer->id;
        }
    }

    private static function updateAccount($id)
    {
        $totalDeposit = Deposit::where('dealer_id', $id)->sum('amount');
        $totalPurchase = Purchase::where('dealer_id', $id)->sum('net_amount');
        $balance = $totalDeposit - $totalPurchase;
        $accountExists = Account::select('id')->where('dealer_id', $id)->first();
        if ($accountExists) {
            $account = Account::where('dealer_id', $id)->first();
            $account->total_deposit = $totalDeposit;
            $account->total_purchase = $totalPurchase;
            $account->balance = $balance;
            $account->created_at = date('Y-m-d');
            $updateAccount = $account->save();
        } else {
            $account = new Account();
            $account->dealer_id = $id;
            $account->total_deposit = $totalDeposit;
            $account->total_purchase = $totalPurchase;
            $account->balance = $balance;
            $account->created_at = date('Y-m-d');
            $updateAccount = $account->save();
        }
        if ($updateAccount) {
            return $updateAccount;
        }
    }
}
