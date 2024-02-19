@extends('backend.layouts.app')

@section('title')
    Activities
@endsection

@section('content')
    <section class="section">
        
        <div class="section-header">
            <h1>Activities</h1>
            <div class="section-header-breadcrumb">
             
                <a
                    href="{{ route('admin.activities.create') }}"
                    class="btn btn-primary form-btn"
                >Activities <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('backend.activities.table')
                </div>
            </div>
        </div>

    </section>
@endsection
