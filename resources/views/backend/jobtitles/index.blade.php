@extends('backend.layouts.app')

@section('title')
    jobtitles
@endsection

@section('content')
    <section class="section">
        
        <div class="section-header">
            <h1>jobtitles</h1>
            <div class="section-header-breadcrumb">
              
                <a
                    href="{{ route('admin.jobtitles.create') }}"
                    class="btn btn-primary form-btn"
                >jobtitle <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('backend.jobtitles.table')
                </div>
            </div>
        </div>

    </section>
@endsection
