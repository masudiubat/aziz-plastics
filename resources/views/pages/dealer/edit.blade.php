@extends('layouts.admin')

@section('title', 'Update Dealer')

@section('breadcrumbs')
<a href="#" class="kt-subheader__breadcrumbs-link"> Dashboard </a><span class="kt-subheader__breadcrumbs-separator"></span>
<a href="{{route('dealer.index')}}" class="kt-subheader__breadcrumbs-link"> Dealers </a><span class="kt-subheader__breadcrumbs-separator"></span>
<a href="#" class="kt-subheader__breadcrumbs-link"> Update Dealer </a>
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
                            Update Dealer
                        </h3>
                    </div>
                </div>
                <!--begin::Form-->
                <form class="kt-form" action="{{route('dealer.update', $dealer->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="kt-portlet__body" style="padding:5px 15px;">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="">Select SDSM:</label>
                                <select id="sdsm" name="sdsm" class="form-control @error('sdsm') is-invalid @enderror">
                                    @if(!is_null($sdsms))
                                    @foreach($sdsms as $sdsm)
                                    <option value="{{$sdsm->id}}" {{$sdsm->id == $dealer->sdsm->id ? 'selected' : ''}}>{{$sdsm->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label>Select DSM:</label>
                                <select id="dsm" name="dsm" class="form-control @error('dsm') is-invalid @enderror">
                                    <option value="{{$dealer->dsm->id}}">{{$dealer->dsm->name}}</option>
                                </select>
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>Select SR:</label>
                                <select id="sr" name="sr" class="form-control @error('sr') is-invalid @enderror">
                                    <option value="{{$dealer->sr->id}}">{{$dealer->sr->name}}</option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label>Company Name:</label>
                                <input type="text" name="company_name" value="{{$dealer->company_name}}" class="form-control" placeholder="Company Name">
                                @error('company_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="">Dealer Name:</label>
                                <input type="text" name="dealer_name" id="dealerName" value="{{$dealer->dealer_name}}" class="form-control" placeholder="Dealer Name">
                            </div>
                            <div class="col-lg-6">
                                <label>Dealer Code:</label>
                                <input type="text" name="dealer_code" value="{{$dealer->dealer_code}}" id="dealerCode" class="form-control" placeholder="Dealer Code">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="">Address:</label>
                                <input type="text" name="address" id="address" value="{{$dealer->address}}" class="form-control" placeholder="Address">
                            </div>
                            <div class="col-lg-6">
                                <label>Phone:</label>
                                <input type="text" name="phone" value="{{$dealer->phone}}" id="phone" class="form-control" placeholder="Phone">
                            </div>
                        </div>

                    </div>
                    <div class="kt-portlet__foot" style="padding: 10px 25px;">
                        <div class="kt-form__actions">
                            <a href="{{route('dealer.index')}}" class="btn btn-secondary">Cancel</a>
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
    $("#sdsm").change(function() {
        var sdsm = $('#sdsm').val();
        var url = "{{url('/search/dsm')}}/" + sdsm;
        $.ajax({
            url: url,
            method: "GET",
        }).done(function(data) {
            var $dsm = $('#dsm');
            $dsm.empty();
            $dsm.append('<option value="" > Select DSM</option>');
            for (var i = 0; i < data.dsms.length; i++) {
                $dsm.append('<option value=' + data.dsms[i]['id'] + '>' + data.dsms[i]['name'] + '</option>');
            }

        });
    });
</script>
<script type="text/javascript">
    $("#dsm").change(function() {
        var dsm = $('#dsm').val();
        var url = "{{url('/search/sr')}}/" + dsm;
        $.ajax({
            url: url,
            method: "GET",
        }).done(function(data) {
            var $sr = $('#sr');
            $sr.empty();
            $sr.append('<option value="" > Select SR</option>');
            for (var i = 0; i < data.srs.length; i++) {
                $sr.append('<option value=' + data.srs[i]['id'] + '>' + data.srs[i]['name'] + '</option>');
            }

        });
    });
</script>
@endpush