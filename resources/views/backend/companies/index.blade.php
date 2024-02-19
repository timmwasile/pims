@extends('backend.layouts.app')

@section('title')
    {{ ucwords(auth()->user()->companyId->name) }} 
@endsection

@section('content')

    <section class="section">

        <div class="section-header">
            <h1>{{ ucwords(auth()->user()->companyId->name) }} </h1>
            <div class="section-header-breadcrumb">
@can('company_create')

                <a href="{{ route('admin.companies.create') }}" class="btn btn-primary form-btn">Company <i
                        class="fas fa-plus"></i></a>
@endcan

            </div>
        </div>

        <div class="section-body">
                <div class="card">
                <div class="card-body">
                    @include('backend.companies.table')
                </div>
            </div>
        </div>

    </section>
@endsection
