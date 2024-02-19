@extends('backend.layouts.app')

@section('title')
    {{ ucwords(auth()->user()->companyId->name) }} Details
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ ucwords(auth()->user()->companyId->name) }} Details</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('admin.companies.index') }}" class="btn btn-primary form-btn float-right">Back</a>
            </div>
        </div>
        @include('stisla-templates::common.errors')
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('backend.companies.show_fields')
                </div>
            </div>
        </div>
    </section>
@endsection
