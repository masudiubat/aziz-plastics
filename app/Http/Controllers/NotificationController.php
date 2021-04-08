<?php

namespace App\Http\Controllers;

use App\User;
use App\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function get_notifications()
    {
        $userId = Auth::user()->id;
        $user = User::with('designation')->findOrFail($userId);
        $userDesignation = $user->designation->short_name;
        if ($userDesignation == 'DSM') {
            $newOrders = Purchase::select('id', 'dealer_id', 'order_id',)
                ->with('dealer', 'order')
                ->where('dsm_id', $userId)
                ->where('dsm_status', 0)
                ->get();
        } elseif ($userDesignation == 'SDSM') {
            $newOrders = Purchase::select('id', 'dealer_id', 'order_id')
                ->with('dealer', 'order')
                ->where('sdsm_id', $userId)
                ->where('dsm_status', 1)
                ->where('sdsm_status', 0)
                ->get();
        } elseif ($userDesignation == 'AO') {
            $newOrders = Purchase::select('id', 'dealer_id', 'order_id')
                ->with('dealer', 'order')
                ->where('sdsm_status', 1)
                ->where('account_status', 0)
                ->get();
        } elseif ($userDesignation == 'GM' || $userDesignation == 'ED') {
            $newOrders = Purchase::select('id', 'dealer_id', 'order_id')
                ->with('dealer', 'order')
                ->where('account_status', 1)
                ->where('gm_ed_status', 0)
                ->get();
        } elseif ($userDesignation == 'FM') {
            $newOrders = Purchase::select('id', 'dealer_id', 'order_id')
                ->with('dealer', 'order')
                ->where('gm_ed_status', 1)
                ->where('factory_status', 0)
                ->get();
        } else {
            $newOrders = Purchase::select('id', 'dealer_id', 'order_id')
                ->with('dealer', 'order')
                ->where('sr_id', $userId)
                ->where('dsm_status', 0)
                ->get();
        }

        return response()->json(['newOrders' => $newOrders], 200);
    }

    public function all_new_orders()
    {
        $userId = Auth::user()->id;
        $user = User::with('designation')->findOrFail($userId);
        $userDesignation = $user->designation->short_name;
        if ($userDesignation == 'DSM') {
            $newOrders = Purchase::with('dealer', 'order')
                ->where('dsm_id', $userId)
                ->where('dsm_status', 0)
                ->get();
        } elseif ($userDesignation == 'SDSM') {
            $newOrders = Purchase::with('dealer', 'order')
                ->where('sdsm_id', $userId)
                ->where('dsm_status', 1)
                ->where('sdsm_status', 0)
                ->get();
        } elseif ($userDesignation == 'AO') {
            $newOrders = Purchase::with('dealer', 'order')
                ->where('sdsm_status', 1)
                ->where('account_status', 0)
                ->get();
        } elseif ($userDesignation == 'GM' || $userDesignation == 'ED') {
            $newOrders = Purchase::with('dealer', 'order')
                ->where('account_status', 1)
                ->where('gm_ed_status', 0)
                ->get();
        } elseif ($userDesignation == 'FM') {
            $newOrders = Purchase::with('dealer', 'order')
                ->where('gm_ed_status', 1)
                ->where('factory_status', 0)
                ->get();
        } else {
            $newOrders = Purchase::with('dealer', 'order')
                ->where('sr_id', $userId)
                ->where('dsm_status', 0)
                ->get();
        }

        return view('pages.order.all-new-order', ['newOrders' => $newOrders]);
    }

    public function show($id)
    {
        $orderDetail = Purchase::with('dealer', 'order')->findOrFail($id);
        return view('pages.order.show', ['orderDetail' => $orderDetail]);
    }
}
