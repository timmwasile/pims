@extends('backend.layouts.app')

@section('title')
    Farm Details
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ ucwords($farm->customerId->name).',' }}  number {{ '('.$farm->number.')' }} details... </h1>
            <div class="section-header-breadcrumb">
                <a
                    href="{{ route('admin.farm_assets.index') }}"
                    class="btn btn-primary form-btn float-right"
                >Back</a>
            </div>
        </div>
        @include('stisla-templates::common.errors')
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('backend.farm_assets.show_fields')
                </div>
            </div>
        </div>
    </section>
@endsection
