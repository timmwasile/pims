@extends('backend.layouts.app')

@section('title')
    Job Levels
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Job Levels</h1>
            <div class="section-header-breadcrumb">
                <a
                    href="{{ route('admin.job-levels.create') }}"
                    class="btn btn-primary form-btn"
                >Job Level <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('backend.job_levels.table')
                </div>
            </div>
        </div>

    </section>
@endsection
