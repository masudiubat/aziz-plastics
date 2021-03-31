@extends('layouts.admin')

@section('title', 'Designation')

@section('breadcrumbs')
<a href="#" class="kt-subheader__breadcrumbs-link"> Designation </a>
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
                    Designations
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href="#" class="btn btn-brand btn-elevate btn-icon-sm" data-toggle="modal" data-target="#new_designation">
                            <i class="la la-plus"></i>
                            New Designation
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
                        <th title="Field #1">Position</th>
                        <th title="Field #2">Name</th>
                        <th title="Field #3">Short Name</th>
                        <th title="Field #4">Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($designations as $designation)
                    @if($designation->order_id != 0)
                    <tr>
                        <td>{{ $designation->order_id }}</td>
                        <td>{{ $designation->name }}</td>
                        <td>{{ $designation->short_name }}</td>
                        <td>
                            <a onclick="event.preventDefault(); editDesignaiton('{{ $designation->id }}');" href="#" title="Edit" data-placement="top" data-toggle="tooltip" data-original-title="Edit" class="btn btn-xs tooltips btn-clean">
                                <i class="la la-edit"></i>
                            </a>

                            <a href="#" onclick="event.preventDefault(); deleteDesignaiton('{{$designation->id}}');" title="Delete" data-placement="top" data-toggle="tooltip" data-original-title="Delete" class="btn btn-xs tooltips btn-clean">
                                <i class="la la-trash" style="color:crimson;"></i>
                            </a>
                            <form id="delete-designation-{{ $designation->id }}" action="{{route('designation.destroy', $designation->id)}}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    <tr></tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            <!--end: Datatable -->
        </div>
    </div>

    <!--begin::New Designation Modal-->
    <div class="modal fade" id="new_designation" tabindex="-1" role="dialog" aria-labelledby="newUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="padding:5px;">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Designation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <!--begin::Form-->
                <form class="kt-form" action="{{ route('designation.store') }}" method="POST">
                    @csrf
                    <div class="modal-body" style="padding:0px;">
                        <!--begin::Portlet-->
                        <div class="kt-portlet">
                            <div class="kt-portlet__body" style="padding: 0px 10px;">
                                <div class="form-group" style="margin-bottom: 1rem;">
                                    <label>Name <span class="text-danger"> * </span></label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" aria-describedby="nameHelp" placeholder="Full Name" required>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin-bottom: 1rem;">
                                    <label>Short Name <span class="text-danger"> * </span></label>
                                    <input type="text" name="short_name" class="form-control @error('short_name') is-invalid @enderror" aria-describedby="emailHelp" placeholder="Short Name" required>
                                    @error('short_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin-bottom: 1rem;">
                                    <label>Designation Position</label>
                                    <input type="text" name="order_id" class="form-control @error('order_id') is-invalid @enderror" aria-describedby="emailHelp" placeholder="Designation Order Id">
                                    @error('order_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!--end::Portlet-->
                    </div>
                    <div class="modal-footer" style="padding: 0px 10px;">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
    <!--end::New Designation Modal-->


    <!--begin::Edit Designation Modal-->
    <div class="modal fade" id="edit_designation" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit Designation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <!--begin::Form-->
                <form class="kt-form" action="{{route('designation.update')}}" method="POST">
                    @csrf
                    <div id="idField"></div>
                    <div class="modal-body">
                        <!--begin::Portlet-->
                        <div class="kt-portlet">

                            <div class="kt-portlet__body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <div id="nameField"></div>
                                </div>
                                <div class="form-group">
                                    <label>Short Name</label>
                                    <div id="shortNameField"></div>
                                </div>
                                <div class="form-group">
                                    <label>Order/Position Id</label>
                                    <div id="orderIdField"></div>
                                </div>
                            </div>

                        </div>
                        <!--end::Portlet-->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
    <!--end::Edit Designation Modal-->
</div>
<!-- end:: Content -->
@endsection

@push('js')
<!--begin::Page Scripts(used by this page) -->
<script src="{{ asset('assets/js/pages/crud/metronic-datatable/base/html-table.js')}}" type="text/javascript"></script>
<!--end::Page Scripts -->

<script type="text/javascript">
    // Function for Edit User...
    function editDesignaiton(id) {
        var url = "{{url('/designation/edit')}}/" + id;
        // console.log(url);
        $.ajax({
            url: url,
            method: "GET",
        }).done(function(data) {
            $('#edit_designation').modal('show');
            var $nameField = $('#nameField');
            $nameField.empty();
            $nameField.append('<input type="text" name="name" class="form-control" aria-describedby="designationHelp" placeholder="Name" required value="' + data.designation.name + '"> ');

            var $shortNameField = $('#shortNameField');
            $shortNameField.empty();
            $shortNameField.append('<input type="text" name="short_name" class="form-control" aria-describedby="tagHelp" placeholder="Short Name" required value="' + data.designation.short_name + '"> ');

            var $orderIdField = $('#orderIdField');
            $orderIdField.empty();
            $orderIdField.append('<input type="text" name="order_id" class="form-control" aria-describedby="tagHelp" placeholder="Order Id" required value="' + data.designation.order_id + '"> ');

            var $idField = $('#idField');
            $idField.empty();
            $idField.append('<input class="form-control" type="hidden" name="id" value="' + data.designation.id + '"> ');

        });
    }

    // Function for delete Designation...
    function deleteDesignaiton(id) {
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
                document.getElementById('delete-designation-' + id).submit();
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