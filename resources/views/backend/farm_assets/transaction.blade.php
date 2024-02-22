@extends('backend.layouts.app')

@section('title')
   Plot
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading m-0">Plot Transaction</h3>
            <div class="filter-container section-header-breadcrumb row justify-content-md-end">
                <a href="{{ route('admin.farm_assets.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
        <div class="content">
            @include('stisla-templates::common.errors')
            <div class="section-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body ">
                                {!! Form::open( ['route' => ['admin.farm_assets.save_to_clear_balance', $plot->id], 'method' => 'post','enctype'=>"multipart/form-data"]) !!}

                                <div class="row">
                                    @include('backend.farm_assets.transactionfields')
                                </div>

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
