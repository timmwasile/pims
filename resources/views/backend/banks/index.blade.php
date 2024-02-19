@extends('backend.layouts.app')

@section('title')
    banks
@endsection

@section('content')
    <section class="section">
        
        <div class="section-header">
            <h1>banks</h1>
            <div class="section-header-breadcrumb">
              
                <a
                    href="{{ route('admin.banks.create') }}"
                    class="btn btn-primary form-btn"
                >bank <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('backend.banks.table')
                </div>
            </div>
        </div>

    </section>
@endsection
