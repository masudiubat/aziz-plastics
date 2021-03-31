@extends('layouts.admin')

@section('title', 'Dealer Details')

@section('breadcrumbs')
<a href="#" class="kt-subheader__breadcrumbs-link"> Dashboard </a><span class="kt-subheader__breadcrumbs-separator"></span>
<a href="#" class="kt-subheader__breadcrumbs-link"> Dealer Details </a>
@endsection

@push('css')

@endpush
@section('content')
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <!--Begin::App-->
    <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">
        <!--Begin:: App Aside Mobile Toggle-->
        <button class="kt-app__aside-close" id="kt_user_profile_aside_close">
            <i class="la la-close"></i>
        </button>
        <!--End:: App Aside Mobile Toggle-->

        <!--Begin:: App Aside-->
        <div class="kt-grid__item kt-app__toggle kt-app__aside" id="kt_user_profile_aside">
            <!--begin:: Widgets/Applications/User/Profile1-->
            <div class="kt-portlet kt-portlet--height-fluid-">
                <div class="kt-portlet__head  kt-portlet__head--noborder">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body kt-portlet__body--fit-y">
                    <!--begin::Widget -->
                    <div class="kt-widget kt-widget--user-profile-1">
                        <div class="kt-widget__head">

                            <div class="kt-widget__content">
                                <div class="kt-widget__section">
                                    <a href="#" class="kt-widget__username">
                                        {{$dealer->company_name}}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="kt-widget__body">
                            <div class="kt-widget__content">
                                <div class="kt-widget__info">
                                    <span class="kt-widget__label">Name:</span>
                                    <a href="#" class="kt-widget__data">{{$dealer->dealer_name}}</a>
                                </div>
                                <div class="kt-widget__info">
                                    <span class="kt-widget__label">Code:</span>
                                    <a href="#" class="kt-widget__data">{{$dealer->dealer_code}}</a>
                                </div>
                                <div class="kt-widget__info">
                                    <span class="kt-widget__label">Address:</span>
                                    <a href="#" class="kt-widget__data">{{$dealer->address}}</a>
                                </div>
                                <div class="kt-widget__info">
                                    <span class="kt-widget__label">Phone:</span>
                                    <a href="#" class="kt-widget__data">{{$dealer->phone}}</a>
                                </div>
                                <div class="kt-widget__info">
                                    <span class="kt-widget__label">SR:</span>
                                    <a href="#" class="kt-widget__data">@if(!is_null($dealer->sr)){{$dealer->sr->name}}@endif</a>
                                </div>
                                <div class="kt-widget__info">
                                    <span class="kt-widget__label">DSM:</span>
                                    <a href="#" class="kt-widget__data">@if(!is_null($dealer->dsm)){{$dealer->dsm->name}}@endif</a>
                                </div>
                                <div class="kt-widget__info">
                                    <span class="kt-widget__label">SDSM:</span>
                                    <a href="#" class="kt-widget__data">@if(!is_null($dealer->sdsm)){{$dealer->sdsm->name}}@endif</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Widget -->
                </div>
            </div>
            <!--end:: Widgets/Applications/User/Profile1-->
        </div>
        <!--End:: App Aside-->

        <!--Begin:: App Content-->
        <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
            <div class="row">
                <div class="col-xl-6">
                    <!--begin:: Widgets/Order Statistics-->
                    <div class="kt-portlet kt-portlet--height-fluid">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Order Details
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <a href="#" class="btn btn-label-brand btn-bold btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Export
                                </a>
                                <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                    <!--begin::Nav-->
                                    <ul class="kt-nav">
                                        <li class="kt-nav__head">
                                            Export Options
                                        </li>
                                        <li class="kt-nav__separator"></li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-drop"></i>
                                                <span class="kt-nav__link-text">CSV</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-calendar-8"></i>
                                                <span class="kt-nav__link-text">PDF</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <!--end::Nav-->
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body kt-portlet__body--fluid">
                            <div class="kt-widget12">

                            </div>
                        </div>
                    </div>
                    <!--end:: Widgets/Order Statistics-->
                </div>
            </div>
        </div>
        <!--End:: App Content-->
    </div>
    <!--End::App-->
</div>
<!-- end:: Content -->
@endsection
@push('js')

@endpush