@extends('layouts.admin')

@section('title', 'New Orders')

@section('breadcrumbs')
<a href="#" class="kt-subheader__breadcrumbs-link"> Dashboard </a><span class="kt-subheader__breadcrumbs-separator"></span>
<a href="#" class="kt-subheader__breadcrumbs-link"> New Orders </a>
@endsection

@push('css')

@endpush
@section('content')
<!-- begin:: Content -->
<div class="kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    New Orders
                </h3>
            </div>
        </div>

        <div class="kt-portlet__body">
            <!--begin: Search Form -->
            <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                <div class="row align-items-center">
                    <div class="col-xl-8 order-2 order-xl-1">
                        <div class="row align-items-center">
                            <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-input-icon kt-input-icon--left">
                                    <input type="text" class="form-control" placeholder="Search..." id="generalSearch">
                                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                        <span><i class="la la-search"></i></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end: Search Form -->
        </div>
        <div class="kt-portlet__body kt-portlet__body--fit">
            <!--begin: Datatable -->

            <table class="kt-datatable" id="html_table" width="100%">
                <thead>
                    <tr>
                        <!-- <th title="Field #1">Record No</th> -->
                        <th title="Field #1">Company</th>
                        <th title="Field #1">Net Amount</th>
                        <th title="Field #5">Paid Amount</th>
                        <th title="Field #5">Date</th>
                        <th title="Field #6"> Acition </th>
                        <th> &nbsp; </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($newOrders as $order)
                    <tr>
                        <td>{{ $order->dealer->company_name }}</td>
                        <td>
                            <span class="kt-widget30__stats">
                                <span class="btn btn-label-brand btn-bold btn-sm">{{ $order->net_amount }} &nbsp; (BDT)</span>
                            </span>
                        </td>
                        <td>
                            @if(!is_null($order->paid_amount))
                            <span class="kt-widget30__stats">
                                <span class="btn btn-label-success btn-bold btn-sm">{{ $order->paid_amount }} &nbsp; (BDT)</span>
                            </span>
                            @else
                            <span class="kt-widget30__stats">
                                <span class="btn btn-label-danger btn-bold btn-sm">Not Paid Yet</span>
                            </span>
                            @endif
                        </td>
                        <td>
                            {{ date("M d, Y", strtotime($order->created_at)) }}
                        </td>
                        <td>
                            <a class="btn btn-primary" href="{{route('ajax.order.show', $order->id)}}" role="button">
                                <i class="la la-eye"></i> Details
                            </a>
                        </td>
                        <td> &nbsp; </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!--end: Datatable -->
        </div>
    </div>
</div>
<!-- end:: Content -->
@endsection

@push('js')
<!--begin::Page Scripts(used by this page) -->
<script src="{{ asset('assets/js/pages/crud/metronic-datatable/base/html-table.js')}}" type="text/javascript"></script>
<!--end::Page Scripts -->
@endpush