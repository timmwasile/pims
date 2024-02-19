@extends('backend.layouts.app')

@section('title')
    Invoices
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Invoices</h1>
            <div class="section-header-breadcrumb">
                <a
                    href="{{ route('admin.invoices.create') }}"
                    class="btn btn-primary form-btn"
                >Loan <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('backend.invoices.table')
                </div>
            </div>
        </div>

    </section>
@endsection
