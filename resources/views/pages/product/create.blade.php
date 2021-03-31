@extends('layouts.admin')

@section('title', 'Create Product')

@section('breadcrumbs')
<a href="#" class="kt-subheader__breadcrumbs-link"> Dashboard </a><span class="kt-subheader__breadcrumbs-separator"></span>
<a href="{{route('product.index')}}" class="kt-subheader__breadcrumbs-link"> Products </a><span class="kt-subheader__breadcrumbs-separator"></span>
<a href="#" class="kt-subheader__breadcrumbs-link"> Create Product </a>
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
                            Create New Product
                        </h3>
                    </div>
                </div>
                <!--begin::Form-->
                <form class="kt-form" action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="kt-portlet__body" style="padding:5px 15px;">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="">Category:</label>
                                <input type="text" name="category" value="{{old('category')}}" class="form-control" placeholder="Category">
                            </div>
                            <div class="col-lg-6">
                                <label>Official Name:</label>
                                <input type="text" name="name" value="{{old('name')}}" id="name" class="form-control" placeholder="Enter Official Name">
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label class="">Model:</label>
                                <input type="text" name="model" value="{{old('model')}}" class="form-control" placeholder="Model">
                            </div>
                            <div class="col-lg-4">
                                <label>Size:</label>
                                <input type="text" name="size" value="{{old('size')}}" class="form-control" placeholder="Size">
                            </div>
                            <div class="col-lg-4">
                                <label>Weight:</label>
                                <input type="text" name="weight" value="{{old('weight')}}" id="weight" class="form-control" placeholder="Weight">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label class="">Price:</label>
                                <input type="text" name="price" id="price" value="{{old('price')}}" class="form-control" placeholder="Price">
                            </div>
                            <div class="col-lg-4">
                                <label>Discount(%):</label>
                                <input type="text" name="discount" value="{{old('discount')}}" id="discount" class="form-control" placeholder="Discount in Percent">
                            </div>
                            <div class="col-lg-4">
                                <label class="">Net Price:</label>
                                <input type="text" name="net_price" value="{{old('net_price')}}" id="net_price" class="form-control" placeholder="Net Price">
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__foot" style="padding: 10px 25px;">
                        <div class="kt-form__actions">
                            <a href="{{route('product.index')}}" class="btn btn-secondary">Cancel</a>
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

<script type="text/javascript">
    $("#discount").change(function() {
        var discount = $('#discount').val();
        var price = $('#price').val();
        var discountValue = (discount / 100) * price;
        var netPrice = price - discountValue;
        $("#net_price").val(netPrice);
    });
</script>
@endpush