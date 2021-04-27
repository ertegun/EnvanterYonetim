@extends('component.card')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Demirbaş</li>
@endsection

@section('table')
    <table id="fixtureTable" class="table table-sm table-striped table-bordered display nowrap" style="width: 100%;"></table>
@endsection

@section('card_link')
    <div class="col-6 col-sm-4 col-md-4 col-lg-3 col-xl-2 mb-2">
        <a href="{{ route('fixture_type') }}" class="btn btn-sm btn-primary btn-block">Türler</a>
    </div>
    <div class="col-6 col-sm-4 col-md-4 col-lg-3 col-xl-2 mr-auto mb-2">
        <a href="{{ route('fixture_brand') }}" class="btn btn-sm btn-primary btn-block">Markalar</a>
    </div>
    <div class="col-6 col-sm-4 col-md-4 col-lg-3 col-xl-2 mr-auto mb-2">
        <a href="{{ route('fixture_brand') }}" class="btn btn-sm btn-primary btn-block">Tedarikçiler</a>
    </div>
    <div class="col-6 col-sm-4 col-md-4 col-lg-3 col-xl-2 ml-auto">
        <button type="button" data-toggle="modal" data-target="#createModal" class="btn btn-sm btn-success btn-block">Yeni Envanter</button>
    </div>
@endsection
