@extends('layouts.admin')

@section('title', 'Product')

@section('breadcrumbs')
<a href="#" class="kt-subheader__breadcrumbs-link"> Dashboard </a><span class="kt-subheader__breadcrumbs-separator"></span>
<a href="#" class="kt-subheader__breadcrumbs-link"> Product </a>
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
                    Products
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">

                        <a href="{{route('product.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i>
                            New Product
                        </a>
                    </div>
                </div>
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
                        <th title="Field #1">Category</th>
                        <th title="Field #1">Name</th>
                        <th title="Field #2">Model</th>
                        <th title="Field #4">Price</th>
                        <th title="Field #5">Discount</th>
                        <th title="Field #5">Net Price</th>
                        <th title="Field #5">Size</th>
                        <th title="Field #5">Weight</th>
                        <th title="Field #6"> Acition </th>
                        <th> &nbsp; </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $key => $product)
                    <tr>
                        <!-- <td>{{ $key + 1 }}</td> -->
                        <td>{{ $product->category }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->model }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->discount }}%</td>
                        <td>{{ $product->net_price }} &nbsp; (BDT)</td>
                        <td>{{ $product->size }}</td>
                        <td>{{ $product->weight }}</td>
                        <td>
                            <a href="{{route('product.edit', $product->id)}}" title="Edit" data-placement="top" data-toggle="tooltip" data-original-title="Edit" class="btn btn-xs tooltips btn-clean">
                                <i class="la la-edit"></i>
                            </a>

                            <a href="#" onclick="event.preventDefault(); deleteProduct('{{$product->id}}');" title="Delete" data-placement="top" data-toggle="tooltip" data-original-title="Delete" class="btn btn-xs tooltips btn-clean">
                                <i class="la la-trash"></i>
                            </a>
                            <form id="delete-product-{{ $product->id }}" action="{{route('product.destroy', $product->id)}}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
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

<script type="text/javascript">
    // Function for delete sub group...
    function deleteProduct(id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                document.getElementById('delete-product-' + id).submit();
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                )
            }
        })
    }
</script>
@endpush