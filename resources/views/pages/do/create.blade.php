@extends('layouts.admin')

@section('title', 'New DO')

@section('breadcrumbs')
<a href="#" class="kt-subheader__breadcrumbs-link"> Dashboard </a><span class="kt-subheader__breadcrumbs-separator"></span>
<a href="#" class="kt-subheader__breadcrumbs-link"> New DO </a>
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
                            New DO
                        </h3>
                    </div>
                </div>
                <!--begin::Form-->
                <form class="kt-form" action="{{route('delivery.order.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="kt-portlet__body" style="padding:5px 15px;">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="">Select Company Name:</label>
                                <select id="companyName" name="company_name" class="form-control @error('company_name') is-invalid @enderror" required>
                                    <option value="">Select Company Name</option>
                                    @if(!is_null($companys))
                                    @foreach($companys as $company)
                                    <option value="{{$company->id}}">{{$company->company_name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label>Address:</label>
                                <input type="text" name="address" value="{{old('address')}}" id="address" class="form-control" placeholder="Address">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="">Mobile:</label>
                                <input type="text" name="phone" value="{{old('phone')}}" id="phone" class="form-control" placeholder="Mobile">
                            </div>
                            <div class="col-lg-6">
                                <label>Dealer Code:</label>
                                <input type="text" name="dealer_code" value="{{old('dealer_code')}}" id="dealerCode" class="form-control" placeholder="Dealer Code">
                            </div>
                        </div>
                        <div class="itemGroup">
                            <div class="form-group row">
                                <div class="col-lg-1">
                                    <label class=""><strong>SL No.</strong></label><br />
                                    <input type="text" class=" form-control serialNo" value="1." readonly="readonly">
                                </div>
                                <div class="col-lg-2">
                                    <label><strong>Model:</strong></label>
                                    <select id="model" name="model" class="form-control @error('model') is-invalid @enderror" required>
                                        <option value="">Select Model</option>
                                        @if(!is_null($models))
                                        @foreach($models as $model)
                                        <option value="{{$model->id}}">{{$model->model}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <label><strong>Size:</strong></label>
                                    <select id="size" name="size" class="form-control @error('size') is-invalid @enderror" required>

                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <label><strong>Quantity:</strong></label>
                                    <input type="text" name="dealer_code" value="{{old('dealer_code')}}" id="dealerCode" class="form-control" placeholder="Dealer Code">
                                </div>
                                <div class="col-lg-2">
                                    <label><strong>Price:</strong></label>
                                    <input type="text" name="dealer_code" value="{{old('dealer_code')}}" id="dealerCode" class="form-control" placeholder="Dealer Code">
                                </div>
                                <div class="col-lg-2">
                                    <label><strong>Amount:</strong></label>
                                    <input type="text" name="dealer_code" value="{{old('dealer_code')}}" id="dealerCode" class="form-control" placeholder="Dealer Code">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row add-more-item">
                            <div class="col-lg-12">
                                <a href="javascript:void(0)" id="add_more_btn" type="button" class="btn btn-success float-right addMore">
                                    Add More
                                </a>
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
                <div class="itemGroupCopy" style="display: none;">
                    <div class="form-group row">
                        <div class="col-lg-1">
                            <input type="text" id="serialNoId_" class="form-control serialNo" readonly="readonly">
                        </div>
                        <div class="col-lg-2">
                            <input type="text" name="dealer_code" value="{{old('dealer_code')}}" id="dealerCode" class="form-control" placeholder="Dealer Code">
                        </div>
                        <div class="col-lg-2">
                            <input type="text" name="dealer_code" value="{{old('dealer_code')}}" id="dealerCode" class="form-control" placeholder="Dealer Code">
                        </div>
                        <div class="col-lg-2">
                            <input type="text" name="dealer_code" value="{{old('dealer_code')}}" id="dealerCode" class="form-control" placeholder="Dealer Code">
                        </div>
                        <div class="col-lg-2">
                            <input type="text" name="dealer_code" value="{{old('dealer_code')}}" id="dealerCode" class="form-control" placeholder="Dealer Code">
                        </div>
                        <div class="col-lg-2">
                            <input type="text" name="dealer_code" value="{{old('dealer_code')}}" id="dealerCode" class="form-control" placeholder="Dealer Code">
                        </div>
                        <div class="col-lg-1">
                            <label class=""> &nbsp; &nbsp; </label>
                            <div class="input-group-addon">
                                <a href="javascript:void(0)" class="btn btn-danger remove"><i class="fa fa-times" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Portlet-->
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}" type="text/javascript"></script>

<script type="text/javascript">
    $("#discount").change(function() {
        var discount = $('#discount').val();
        var price = $('#price').val();
        var discountValue = (discount / 100) * price;
        var netPrice = price - discountValue;
        $("#net_price").val(netPrice);
    });
</script>
<script>
    $(document).ready(function() {
        //add more item in list
        var Counter = 2;
        $(".addMore").click(function() {
            $('.itemGroupCopy .serialNo').attr('id', 'serialNoId_' + Counter);
            $('#serialNoId_' + Counter).attr('value', Counter);

            var fieldHTML = '<div class="form-group itemGroup">' + $(".itemGroupCopy").html() + '</div>';
            $('body').find('.itemGroup:last').after(fieldHTML);

            Counter++;
        });

        //remove item from list
        $("body").on("click", ".remove", function() {
            $(this).parents(".itemGroup").remove();
        });
    });
</script>

<script type="text/javascript">
    $("#companyName").change(function() {
        var companyName = $('#companyName').val();
        var url = "{{url('/search/company/details')}}/" + companyName;
        $.ajax({
            url: url,
            method: "GET",
        }).done(function(data) {
            $('#address').attr('value', data.company.address);
            $('#phone').attr('value', data.company.phone);
            $('#dealerCode').attr('value', data.company.dealer_code);
        });
    });
</script>
<script type="text/javascript">
    $("#model").change(function() {
        var model = $('#model').val();
        var url = "{{url('/search/product/size')}}/" + model;
        $.ajax({
            url: url,
            method: "GET",
        }).done(function(data) {
            var $size = $('#size');
            $size.empty();
            $size.append('<option value="" > Select Size</option>');
            for (var i = 0; i < data.sizes.length; i++) {
                $size.append('<option value=' + data.sizes[i]['id'] + '>' + data.sizes[i]['size'] + '</option>');
            }
        });
    });
</script>
@endpush