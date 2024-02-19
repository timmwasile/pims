@extends('backend.layouts.app')

@section('title')
    offices
@endsection

@section('content')
    <section class="section">
        
        <div class="section-header">
            <h1>offices</h1>
            <div class="section-header-breadcrumb">
              
                <a
                    href="{{ route('admin.offices.create') }}"
                    class="btn btn-primary form-btn"
                >office <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('backend.offices.table')
                </div>
            </div>
        </div>

    </section>
@endsection
