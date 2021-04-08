@extends('layouts.admin')

@section('title', 'User Role')

@section('breadcrumbs')
<a href="#" class="kt-subheader__breadcrumbs-link"> User Role </a>
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
                    User Role
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">

                        <a href="#" class="btn btn-brand btn-elevate btn-icon-sm" data-toggle="modal" data-target="#assign_role">
                            <i class="la la-plus"></i>
                            Assign Role to User
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="kt-portlet__body" style="padding: 0px 20px">
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
                        <th title="Field #1">User Name</th>
                        <th title="Field #2">ID</th>
                        <th title="Field #3">Designation</th>
                        <th title="Field #4">Role</th>
                        <th title="Field #5">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    @if($user->user_id != 1)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->user_id }}</td>
                        <td>@if(!is_null($user->designation)){{ $user->designation->short_name }}@endif</td>
                        <td>
                            @if(!is_null($user->roles))
                            @foreach($user->roles as $role)
                            {{ $role->name }}
                            @endforeach
                            @endif
                        </td>
                        <td>
                            <a onclick="event.preventDefault(); editUser('{{ $user->id }}');" href="#" title="Edit" data-placement="top" data-toggle="tooltip" data-original-title="Edit" class="btn btn-xs tooltips btn-clean">
                                <i class="la la-edit"></i>
                            </a>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            <!--end: Datatable -->
        </div>
    </div>

    <!--begin::New User Modal-->
    <div class="modal fade" id="assign_role" tabindex="-1" role="dialog" aria-labelledby="newUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style="padding:5px;">
                    <h5 class="modal-title" id="exampleModalLabel">Add Role to New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <!--begin::Form-->
                <form class="kt-form" action="{{ route('role.user.store') }}" method="POST">
                    @csrf
                    <div class="modal-body" style="padding:0px;">
                        <!--begin::Portlet-->
                        <div class="kt-portlet">
                            <div class="kt-portlet__body" style="padding: 0px 10px;">
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label class="">Select User Name:</label>
                                        <select id="userName" name="user" class="form-control @error('user') is-invalid @enderror" required>
                                            <option value="">Select User Name</option>
                                            @if(!is_null($usersWithoutAnyRoles))
                                            @foreach($usersWithoutAnyRoles as $user)
                                            <option value="{{$user->id}}">{{$user->name}} - ({{$user->user_id }})</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="">Select Role:</label>
                                        <select id="role" name="role" class="form-control @error('role') is-invalid @enderror" required>
                                            <option value="">Select Role</option>
                                            @if(!is_null($roles))
                                            @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
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
    <!--end::New User Modal-->


    <!--begin::Edit User Modal-->
    <div class="modal fade" id="edit_user" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <!--begin::Form-->
                <form class="kt-form" action="{{route('user.update')}}" method="POST">
                    @csrf
                    <div id="idField"></div>
                    <div class="modal-body">
                        <!--begin::Portlet-->
                        <div class="kt-portlet">

                            <div class="kt-portlet__body">
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Name</label>
                                        <div id="nameField"></div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Email</label>
                                        <div id="emailField"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Phone</label>
                                        <div id="phoneField"></div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Select Designation</label>
                                        <select class="form-control" id="designationField" name="designation">

                                        </select>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Select Supervisor</label>
                                        <select class="form-control" id="supervisorField" name="supervisor">

                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>User Id</label>
                                        <div id="userIdField"></div>
                                    </div>
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
    <!--end::Edit User Modal-->

    <!--begin::Chagne Password Modal-->
    <div class="modal fade" id="change_password" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <!--begin::Form-->
                <form class="kt-form" action="{{route('user.change.password')}}" method="POST">
                    @csrf
                    <div id="idField">
                        <input class="form-control" type="hidden" name="userid" id="userid" value="">
                    </div>
                    <div class="modal-body">
                        <!--begin::Portlet-->
                        <div class="kt-portlet">

                            <div class="kt-portlet__body">
                                <div class="form-group">
                                    <label>Password <span class="text-danger"> * </span></label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" aria-describedby="passwordHelp" placeholder="Password" required>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Password Confirmation <span class="text-danger"> * </span></label>
                                    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" aria-describedby="passwordHelp" placeholder="password Confirmation" required>
                                    @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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
    <!--end::Change Password Modal-->
</div>
<!-- end:: Content -->
@endsection

@push('js')
<!--begin::Page Scripts(used by this page) -->
<script src="{{ asset('assets/js/pages/crud/metronic-datatable/base/html-table.js')}}" type="text/javascript"></script>
<!--end::Page Scripts -->

<script type="text/javascript">
    $("#designation").change(function() {
        var designation = $('#designation').val();
        var url = "{{url('/search/supervisor')}}/" + designation;
        $.ajax({
            url: url,
            method: "GET",
        }).done(function(data) {
            var $supervisor = $('#supervisor');
            $supervisor.empty();
            $supervisor.append('<option value="" > Select Supervisor</option>');
            for (var j = 0; j < data.supervisorList.length; j++) {
                $supervisor.append('<option value=' + data.supervisorList[j]['id'] + '>' + data.supervisorList[j]['name'] + '</option>');
            }

        });
    });
</script>

<script type="text/javascript">
    $("#supervisor").change(function() {
        var designation = $('#designation').val();
        var supervisor = $('#supervisor').val();
        var url = "{{url('/create/userid')}}/" + designation + ',' + supervisor;
        console.log(url);
        $.ajax({
            url: url,
            method: "GET",
        }).done(function(data) {
            console.log(data.userId);
        });
    });
</script>


<script type="text/javascript">
    // Function for Edit User...
    function editUser(id) {
        var url = "{{url('/user/edit')}}/" + id;
        // console.log(url);
        $.ajax({
            url: url,
            method: "GET",
        }).done(function(data) {
            console.log(data.user);
            $('#edit_user').modal('show');
            var $nameField = $('#nameField');
            $nameField.empty();
            $nameField.append('<input type="text" name="name" class="form-control" aria-describedby="designationHelp" placeholder="Designation" required value="' + data.user.name + '"> ');

            var $emailField = $('#emailField');
            $emailField.empty();
            $emailField.append('<input type="text" name="email" class="form-control" aria-describedby="tagHelp" placeholder="Email" required value="' + data.user.email + '"> ');

            var $phoneField = $('#phoneField');
            $phoneField.empty();
            $phoneField.append('<input type="text" name="phone" class="form-control" aria-describedby="tagHelp" placeholder="Phone" required value="' + data.user.phone + '"> ');

            var $designationField = $('#designationField');
            $designationField.empty();
            for (var i = 0; i < data.designations.length; i++) {
                if (data.designations[i]['id'] != 1) {
                    if (data.designations[i]['id'] == data.user.designation.id) {
                        $designationField.append('<option selected value=' + data.designations[i]['id'] + '>' + data.designations[i]['short_name'] + "-" + data.designations[i]['name'] + '</option>');
                    } else {
                        $designationField.append('<option value=' + data.designations[i]['id'] + '>' + data.designations[i]['short_name'] + "-" + data.designations[i]['name'] + '</option>');
                    }
                }
            }

            var $supervisorField = $('#supervisorField');
            $supervisorField.empty();
            for (var i = 0; i < data.supervisorList.length; i++) {
                if (data.supervisorList[i]['id'] != 1) {
                    if (data.supervisorList[i]['id'] == data.user.parent_id) {
                        $supervisorField.append('<option selected value=' + data.supervisorList[i]['id'] + '>' + data.supervisorList[i]['name'] + '</option>');
                    } else {
                        $supervisorField.append('<option value=' + data.supervisorList[i]['id'] + '>' + data.supervisorList[i]['name'] + '</option>');
                    }
                }
            }

            var $userIdField = $('#userIdField');
            $userIdField.empty();
            $userIdField.append('<input type="text" name="user_id" class="form-control" aria-describedby="tagHelp" placeholder="User Id" required value="' + data.user.user_id + '"> ');

            var $idField = $('#idField');
            $idField.empty();
            $idField.append('<input class="form-control" type="hidden" name="id" value="' + data.user.id + '"> ');

        });
    }

    // Function for Change User password...
    function changeUserPassword(id) {
        $('#change_password').modal('show');
        $("#userid").val(id);
    }

    // Function for delete User...
    function deleteUser(id) {
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
                document.getElementById('delete-user-' + id).submit();
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