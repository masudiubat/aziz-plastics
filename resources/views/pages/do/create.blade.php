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
                                <div class="col-lg-2 modelGroup">
                                    <label><strong>Model:</strong></label>
                                    <select id="model" name="model[]" class="form-control @error('model') is-invalid @enderror model" required>
                                        <option value="">Select Model</option>
                                        @if(!is_null($models))
                                        @foreach($models as $model)
                                        <option value="{{$model->id}}">{{$model->model}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-lg-2 sizeGroup">
                                    <label><strong>Size:</strong></label>
                                    <select id="size" name="size[]" class="form-control @error('size') is-invalid @enderror size" required>
                                        <option value="">Select Size</option>
                                    </select>
                                </div>
                                <div class="col-lg-2 quantityGroup">
                                    <label><strong>Quantity:</strong></label>
                                    <input type="text" name="quantity[]" value="{{old('quantity')}}" id="quantity" class="form-control quantity" placeholder="Quantity">
                                </div>
                                <div class="col-lg-2">
                                    <label><strong>Price:</strong></label>
                                    <input type="text" name="price[]" value="{{old('price')}}" id="price" class="form-control price" placeholder="Price">
                                </div>
                                <div class="col-lg-2 amountGroup">
                                    <label><strong>Amount:</strong></label>
                                    <input type="text" name="amount[]" value="0" id="amount" class="form-control amount" placeholder="Amount">
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
                        <div class="form-group row">
                            <div class="col-lg-8">
                                <label><strong>Remark:</strong></label>
                                <textarea class="form-control" id="remark" name="remark" rows="4"></textarea>
                            </div>
                            <div class="col-lg-2">
                                <label><strong>Total:</strong></label>
                                <label><strong>Discount (%):</strong></label>
                                <label><strong>Net Total:</strong></label>
                            </div>
                            <div class="col-lg-2">
                                <div class="total" id="total"></div>
                                <input type="text" name="discount" value="{{old('discount')}}" id="discount" class="form-control discount" placeholder="Discount">
                                <div class="netTotal" id="netTotal"></div>
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
                <div class="itemGroupCopy" style="display: none; margin-bottom: 5px;">
                    <div class="form-group row" style="margin-bottom:5px;">
                        <div class="col-lg-1">
                            <label><strong>SL No. </strong></label>
                            <input type="text" id="serialNoId_" class="form-control serialNo" readonly="readonly">
                        </div>
                        <div class="col-lg-2 modelGroup">
                            <label><strong>Model:</strong></label>
                            <select id="model_" name="model[]" class="form-control @error('model') is-invalid @enderror model" required>
                                <option value="">Select Model</option>
                                @if(!is_null($models))
                                @foreach($models as $model)
                                <option value="{{$model->id}}">{{$model->model}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-lg-2 sizeGroup">
                            <label><strong>Size:</strong></label>
                            <select id="size_" name="size[]" class="form-control @error('size') is-invalid @enderror size" required>
                                <option value="">Select Size</option>
                            </select>
                        </div>
                        <div class="col-lg-2 quantityGroup">
                            <label><strong>Quantity:</strong></label>
                            <input type="text" name="quantity[]" value="{{old('quantity')}}" id="quantity_" class="form-control quantity" placeholder="Quantity">
                        </div>
                        <div class="col-lg-2">
                            <label><strong>Price:</strong></label>
                            <input type="text" name="price[]" value="{{old('price')}}" id="price_" class="form-control price" placeholder="Price">
                        </div>
                        <div class="col-lg-2 amountGroup">
                            <label><strong>Amount:</strong></label>
                            <input type="text" name="amount[]" value="0" id="amount_" class="form-control amount" placeholder="Amount">
                        </div>
                        <div class="col-lg-1">
                            <label> &nbsp; </label>
                            <div class="input-group-addon">
                                <a href="javascript:void(0)" class="btn btn-danger btn-xs remove"><i class="fa fa-times" aria-hidden="true"></i></a>
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
        var totalAmount = 0;
        //add more item in list
        var Counter = 2;
        $(".addMore").click(function() {
            $('.itemGroupCopy .serialNo').attr('id', 'serialNoId_' + Counter);
            $('.itemGroupCopy .model').attr('id', 'model_' + Counter);
            $('.itemGroupCopy .size').attr('id', 'size_' + Counter);
            $('.itemGroupCopy .quantity').attr('id', 'quantity_' + Counter);
            $('.itemGroupCopy .price').attr('id', 'price_' + Counter);
            $('.itemGroupCopy .amount').attr('id', 'amount_' + Counter);
            $('#serialNoId_' + Counter).attr('value', Counter);

            var fieldHTML = '<div class="form-group itemGroup">' + $(".itemGroupCopy").html() + '</div>';
            $('body').find('.itemGroup:last').after(fieldHTML);

            Counter++;
        });

        //remove item from list
        $("body").on("click", ".remove", function() {
            $(this).parents(".itemGroup").remove();
        });


        $('body').on('click', '.itemGroup .modelGroup', function(ev) {
            _parent = $(this).parents('.itemGroup');
            var model = _parent.children().children().children('.model').val();
            if (model !== undefined && model != '') {
                var url = "{{url('/search/product/size')}}/" + model;
                $.ajax({
                    url: url,
                    method: "GET",
                }).done(function(data) {
                    _parent.children().children().children('.size').empty();
                    _parent.children().children().children('.size').append('<option value="" > Select Size</option>');
                    for (var i = 0; i < data.sizes.length; i++) {
                        _parent.children().children().children('.size').append('<option value=' + data.sizes[i]['id'] + '>' + data.sizes[i]['size'] + '</option>');
                    }
                });
            }
        });

        $('body').on('click', '.itemGroup .sizeGroup', function(ev) {
            _parent = $(this).parents('.itemGroup');
            var size = _parent.children().children().children('.size').val();
            if (size !== undefined && size != '') {
                var url = "{{url('/search/product/price')}}/" + size;
                $.ajax({
                    url: url,
                    method: "GET",
                }).done(function(data) {
                    _parent.children().children().children('.price').empty();
                    _parent.children().children().children('.amount').empty();
                    _parent.children().children().children('.price').attr('value', data.price.net_price);
                    _parent.children().children().children('.amount').attr('value', data.price.net_price);
                    totalAmount = totalAmount + data.price.net_price;
                });
            }
        });


        $('body').on('change', '.itemGroup .quantityGroup', function(ev) {
            _parent = $(this).parents('.itemGroup');
            var quantity = _parent.children().children().children('.quantity').val();
            if (quantity !== undefined && quantity != '') {
                var price = _parent.children().children().children('.price').val();
                var amount = quantity * price;
                _parent.children().children().children('.amount').attr('value', amount);

            }
        });




    });
</script>

<script type="text/javascript">
    $(".amount").change(function() {
        var amount = $('.amount').val();
        console.log("Amount: " + amount);
    });
</script>
@endpush