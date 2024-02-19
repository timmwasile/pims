@extends('backend.layouts.app')

@section('title')
    Job Level Details
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Job Level Details</h1>
            <div class="section-header-breadcrumb">
                <a
                    href="{{ route('admin.job-levels.index') }}"
                    class="btn btn-primary form-btn float-right"
                >Back</a>
            </div>
        </div>
        @include('stisla-templates::common.errors')
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('backend.job_levels.show_fields')
                </div>
            </div>
        </div>
    </section>
@endsection
