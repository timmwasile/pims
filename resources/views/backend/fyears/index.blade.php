@extends('backend.layouts.app')

@section('title')
    FYear
@endsection

@section('content')
    <section class="section">
        
        <div class="section-header">
            <h1>Financial Year</h1>
            <div class="section-header-breadcrumb">
             
                <a
                    href="{{ route('admin.fyears.create') }}"
                    class="btn btn-primary form-btn"
                >Financial Year <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('backend.fyears.table')
                </div>
            </div>
        </div>

    </section>
@endsection
