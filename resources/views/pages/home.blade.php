@extends('layouts.admin')

@section('title', 'Dashboard')

@section('breadcrumbs', '')

@push('css')
<!--begin::Page Custom Styles(used by this page) -->
<link href="{{asset('assets/css/pages/pricing/pricing-1.css')}}" rel="stylesheet" type="text/css" />
<!--end::Page Custom Styles -->
@endpush

@section('content')
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <!--begin::Portlet-->
    <div class="kt-portlet">

        <div class="kt-portlet__body">
            <div class="kt-pricing-1 kt-pricing-1--fixed">
                <div class="kt-pricing-1__items row">

                    <div class="kt-pricing-1__item col-lg-3">
                        <div class="kt-pricing-1__visual">
                            <div class="kt-pricing-1__hexagon1"></div>
                            <div class="kt-pricing-1__hexagon2"></div>
                            <span class="kt-pricing-1__icon kt-font-brand"><i class="fa flaticon-web"></i></span>
                        </div>
                        <span class="kt-pricing-1__price"></span>
                        <h2 class="kt-pricing-1__subtitle" style="margin-top: -10px;">Profiles</h2>
                        <span class="kt-pricing-1__description">
    					</span>
                        <div class="kt-pricing-1__btn">
                            <a href="{{route('profile.index')}}" class="btn btn-brand btn-wide btn-bold btn-upper">Go For Details</a>
                        </div>
                    </div>

                    <div class="kt-pricing-1__item col-lg-3">
                        <div class="kt-pricing-1__visual">
                            <div class="kt-pricing-1__hexagon1"></div>
                            <div class="kt-pricing-1__hexagon2"></div>
                            <span class="kt-pricing-1__icon kt-font-brand"><i class="fa flaticon-customer"></i></span>
                        </div>
                        <span class="kt-pricing-1__price"></span>
                        <h2 class="kt-pricing-1__subtitle">Multisports</h2>
                        <span class="kt-pricing-1__description">
    					</span>
                        <div class="kt-pricing-1__btn">
                            <a href="{{route('multisports.index')}}" class="btn btn-brand btn-wide btn-bold btn-upper">Go For Details</a>
                        </div>
                    </div>

                    <div class="kt-pricing-1__item col-lg-3">
                        <div class="kt-pricing-1__visual">
                            <div class="kt-pricing-1__hexagon1"></div>
                            <div class="kt-pricing-1__hexagon2"></div>
                            <span class="kt-pricing-1__icon kt-font-brand"><i class="fa flaticon-users-1"></i></span>
                        </div>
                        <span class="kt-pricing-1__price"></span>
                        <h2 class="kt-pricing-1__subtitle">Members</h2>
                        <span class="kt-pricing-1__description">
    					</span>
                        <div class="kt-pricing-1__btn">
                            <a href="{{route('member.index')}}" class="btn btn-brand btn-wide btn-bold btn-upper">Go For Details</a>
                        </div>
                    </div>

                    <div class="kt-pricing-1__item col-lg-3">
                        <div class="kt-pricing-1__visual">
                            <div class="kt-pricing-1__hexagon1"></div>
                            <div class="kt-pricing-1__hexagon2"></div>
                            <span class="kt-pricing-1__icon kt-font-brand"><i class="fa flaticon2-cup"></i></span>
                        </div>
                        <span class="kt-pricing-1__price"></span>
                        <h2 class="kt-pricing-1__subtitle">Awards</h2>
                        <span class="kt-pricing-1__description">
    					</span>
                        <div class="kt-pricing-1__btn">
                            <a href="{{route('award.index')}}" class="btn btn-brand btn-wide btn-bold btn-upper">Go For Details</a>
                        </div>
                    </div>

                </div>

                <div class="kt-pricing-1__items row">

                    <div class="kt-pricing-1__item col-lg-3">
                        <div class="kt-pricing-1__visual">
                            <div class="kt-pricing-1__hexagon1"></div>
                            <div class="kt-pricing-1__hexagon2"></div>
                            <span class="kt-pricing-1__icon kt-font-brand"><i class="fa flaticon2-layers"></i></span>
                        </div>
                        <span class="kt-pricing-1__price"></span>
                        <h2 class="kt-pricing-1__subtitle" style="margin-top: -10px;">Certifications</h2>
                        <span class="kt-pricing-1__description">
    					</span>
                        <div class="kt-pricing-1__btn">
                            <a href="{{route('certification.type.index')}}" class="btn btn-brand btn-wide btn-bold btn-upper">Go For Details</a>
                        </div>
                    </div>

                    <div class="kt-pricing-1__item col-lg-3">
                        <div class="kt-pricing-1__visual">
                            <div class="kt-pricing-1__hexagon1"></div>
                            <div class="kt-pricing-1__hexagon2"></div>
                            <span class="kt-pricing-1__icon kt-font-brand"><i class="fa flaticon-customer"></i></span>
                        </div>
                        <span class="kt-pricing-1__price"></span>
                        <h2 class="kt-pricing-1__subtitle">Entities</h2>
                        <span class="kt-pricing-1__description">
    					</span>
                        <div class="kt-pricing-1__btn">
                            <a href="{{route('entity.index')}}" class="btn btn-brand btn-wide btn-bold btn-upper">Go For Details</a>
                        </div>
                    </div>

                    <div class="kt-pricing-1__item col-lg-3">
                        <div class="kt-pricing-1__visual">
                            <div class="kt-pricing-1__hexagon1"></div>
                            <div class="kt-pricing-1__hexagon2"></div>
                            <span class="kt-pricing-1__icon kt-font-brand"><i class="fa flaticon-upload"></i></span>
                        </div>
                        <span class="kt-pricing-1__price"></span>
                        <h2 class="kt-pricing-1__subtitle">Upload Data</h2>
                        <span class="kt-pricing-1__description">
    					</span>
                        <div class="kt-pricing-1__btn">
                            <a href="{{route('csv.upload')}}" class="btn btn-brand btn-wide btn-bold btn-upper">Go For Details</a>
                        </div>
                    </div>

                    <div class="kt-pricing-1__item col-lg-3">
                        <div class="kt-pricing-1__visual">
                            <div class="kt-pricing-1__hexagon1"></div>
                            <div class="kt-pricing-1__hexagon2"></div>
                            <span class="kt-pricing-1__icon kt-font-brand"><i class="fa flaticon-users-1"></i></span>
                        </div>
                        <span class="kt-pricing-1__price"></span>
                        <h2 class="kt-pricing-1__subtitle">User Management</h2>
                        <span class="kt-pricing-1__description">
    					</span>
                        <div class="kt-pricing-1__btn">
                            <a href="{{route('user.index')}}" class="btn btn-brand btn-wide btn-bold btn-upper">Go For Details</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--end::Portlet-->
</div>
<!-- end:: Content -->

@endsection

@push('js')


@endpush