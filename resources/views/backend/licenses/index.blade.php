@extends('backend.layouts.app')

@section('title')
    License
@endsection

@section('content')

    <section class="section">

        <div class="section-header">
            <h1>License</h1>
            <div class="section-header-breadcrumb">
@can('license_create')

                <a href="{{ route('admin.licenses.create') }}" class="btn btn-primary form-btn">Licence <i
                        class="fas fa-plus"></i></a>
@endcan

            </div>
        </div>

        <div class="section-body">
                <div class="card">
                <div class="card-body">
                    @include('backend.licenses.table')
                </div>
            </div>
        </div>

    </section>
@endsection
