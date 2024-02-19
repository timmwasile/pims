@extends('backend.layouts.app')

@section('title')
    Admin Details
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Admin Details</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('admin.admins.index') }}" class="btn btn-primary form-btn float-right">Back</a>
            </div>
        </div>
        @include('stisla-templates::common.errors')
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('backend.admins.show_fields')
                </div>
            </div>
        </div>
    </section>
@endsection
