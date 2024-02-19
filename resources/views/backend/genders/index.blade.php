@extends('backend.layouts.app')

@section('title')
    genders
@endsection

@section('content')
    <section class="section">
        
        <div class="section-header">
            <h1>genders</h1>
            <div class="section-header-breadcrumb">
              
                <a
                    href="{{ route('admin.genders.create') }}"
                    class="btn btn-primary form-btn"
                >gender <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('backend.genders.table')
                </div>
            </div>
        </div>

    </section>
@endsection
