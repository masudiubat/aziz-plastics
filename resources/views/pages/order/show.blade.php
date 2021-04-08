@extends('layouts.admin')

@section('title', 'Order Details')

@section('breadcrumbs')
<a href="#" class="kt-subheader__breadcrumbs-link"> New Orders </a><span class="kt-subheader__breadcrumbs-separator"></span>
<a href="#" class="kt-subheader__breadcrumbs-link"> Order Details </a>
@endsection

@push('css')

@endpush
@section('content')
<!-- begin:: Content -->
<div class="kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">
    <!--begin:: Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__body">
            <div class="kt-widget kt-widget--user-profile-3">
                <div class="kt-widget__top">
                    <div class="kt-widget__content">
                        <div class="kt-widget__head">
                            <a href="#" class="kt-widget__username">
                                @if(!is_null($orderDetail->dealer)){{$orderDetail->dealer->company_name}}@endif
                            </a>

                            <div class="kt-widget__action">
                                <a class="btn btn-label-success btn-sm btn-upper">Approve</a>&nbsp;
                                <a class="btn btn-label-danger btn-sm btn-upper">Refuse</a>
                            </div>
                        </div>

                        <div class="kt-widget__subhead">
                            <a href="#">Dealer Name: @if(!is_null($orderDetail->dealer)){{$orderDetail->dealer->dealer_name}}@endif</a><br />
                            <a href="#">Address: @if(!is_null($orderDetail->dealer)){{$orderDetail->dealer->address}}@endif</a><br />
                            <a href="#">Dealer Code: @if(!is_null($orderDetail->dealer)){{$orderDetail->dealer->dealer_code}}@endif</a>
                        </div>
                        <div class="kt-widget__info">
                            <div class="kt-widget__desc">
                                <a href="#">Order Id: @if(!is_null($orderDetail->order)){{$orderDetail->order->order_number}}@endif</a><br />
                                <a href="#">Order Date: @if(!is_null($orderDetail)){{ date("M d, Y", strtotime($orderDetail->created_at)) }}@endif</a><br />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-widget__bottom">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Products
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <!--begin::Section-->
                            <div class="kt-section">
                                <div class="kt-section__content">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>SL.</th>
                                                <th>Category</th>
                                                <th>Name</th>
                                                <th>Model</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(!is_null($orderDetail->order->order_details))
                                            @foreach($orderDetail->order->order_details as $key => $detail)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>@if(!is_null($detail->product)){{$detail->product->category}}@endif</td>
                                                <td>@if(!is_null($detail->product)){{$detail->product->name}}@endif</td>
                                                <td>@if(!is_null($detail->product)){{$detail->product->model}}@endif</td>
                                                <td>@if(!is_null($detail)){{$detail->price}}@endif</td>
                                                <td>@if(!is_null($detail)){{$detail->quantity}}@endif</td>
                                                <td>@if(!is_null($detail)){{$detail->total}}@endif</td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--end::Section-->
                        </div>
                        <!--end::Form-->
                    </div>

                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Payment Details
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <!--begin::Section-->
                            <div class="kt-section">
                                <div class="kt-section__content">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <th>Total Amount</th>
                                                <td>@if(!is_null($orderDetail)){{$orderDetail->total_amount}} &nbsp; BDT @endif</td>
                                                <th>Discount (%)</th>
                                                <td>@if(!is_null($orderDetail)){{$orderDetail->discount}}@endif</td>
                                                <th>Net Amount</th>
                                                <td>@if(!is_null($orderDetail)){{$orderDetail->net_amount}} &nbsp; BDT @endif</td>
                                            </tr>
                                            <tr>
                                                <th>Paid Amount</th>
                                                <td>
                                                    @if(!is_null($orderDetail->paid_amount))
                                                    <span class="kt-widget30__stats">
                                                        <span class="btn btn-label-success btn-bold btn-sm">{{ $orderDetail->paid_amount }} &nbsp; (BDT)</span>
                                                    </span>
                                                    @else
                                                    <span class="kt-widget30__stats">
                                                        <span class="btn btn-label-danger btn-bold btn-sm">Not Paid Yet</span>
                                                    </span>
                                                    @endif
                                                </td>
                                                <th>cheque Image</th>
                                                <td colspan="3">

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--end::Section-->
                        </div>
                        <!--end::Form-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end:: Portlet-->
</div>
<!-- end:: Content -->
@endsection
@push('js')

@endpush