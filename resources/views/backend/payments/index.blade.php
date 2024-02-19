@extends('backend.layouts.app')

@section('title')
    payments
@endsection

@section('content')
    <section class="section">
        
        <div class="section-header">
            <h1>Payments</h1>
            <div class="section-header-breadcrumb">
              
                <a
                    href="{{ route('admin.payments.create') }}"
                    class="btn btn-primary form-btn"
                >Payment <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('backend.payments.table')
                </div>
            </div>
        </div>

    </section>
@endsection
