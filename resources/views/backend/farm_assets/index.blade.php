@extends('backend.layouts.app')

@section('title')
    Farm Asset
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Farm</h1>
            <div class="section-header-breadcrumb">
                <a
                    href="{{ route('admin.farm_assets.create') }}"
                    class="btn btn-primary form-btn"
                >Create Asset (farmer)  <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('backend.farm_assets.table')
                </div>
            </div>
        </div>

    </section>
@endsection
