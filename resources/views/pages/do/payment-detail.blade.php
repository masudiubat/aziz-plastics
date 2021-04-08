@extends('layouts.admin')

@section('title', 'Payment Details')

@section('breadcrumbs')
<a href="#" class="kt-subheader__breadcrumbs-link"> Dashboard </a><span class="kt-subheader__breadcrumbs-separator"></span>
<a href="#" class="kt-subheader__breadcrumbs-link"> New DO </a><span class="kt-subheader__breadcrumbs-separator"></span>
<a href="#" class="kt-subheader__breadcrumbs-link"> Payment Details </a>
@endsection

@push('css')

@endpush

@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="col-md-12">
            <!--begin::Portlet-->
            <div class="kt-portlet">
                <div class="kt-portlet__head" style="min-height: 35px;">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Add Payment Details
                        </h3>
                    </div>
                </div>
                <!--begin::Form-->
                <form class="kt-form" action="{{route('order.payment.detail.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="dealer_id" value="{{$dealer->id}}">
                    <input type="hidden" name="order_id" value="{{$order->id}}">
                    <div class="kt-portlet__body" style="padding:5px 15px;">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="">Company Name:</label>
                                <input type="text" name="company_name" value="{{$dealer->company_name}}" id="companyName" class="form-control companyName">
                            </div>
                            <div class="col-lg-6">
                                <label>Amount:</label>
                                <input type="text" name="amount" value="{{old('amount')}}" id="amount" class="form-control" placeholder="Amount">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label class="">Photo:</label>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <img id="output" height="140px" width="200px" /><br /><br />
                                    <input type="file" name="image" class="" id="insertImage" accept="image/*" onchange="loadFile(event)" />
                                    <span class="text-danger">{{ $errors->first('image') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="">Date:</label>
                                <div class="input-group date">
                                    <input type="text" name="date" class="form-control" readonly="" placeholder="yyyy-mm-dd" id="kt_datepicker_1" data-date-format="yyyy-mm-dd">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="la la-calendar-check-o"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__foot" style="padding: 10px 25px;">
                        <div class="kt-form__actions">
                            <a href="{{route('delivery.order.index')}}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" name="submit" class="btn btn-primary float-right">Submit</button>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Portlet-->
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}" type="text/javascript"></script>
<script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
    };
</script>
@endpush