@extends('backend.layouts.app')

@section('title')
    Employees
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Employees</h1>
            <div class="section-header-breadcrumb">
                <a
                    href="{{ route('admin.employees.create') }}"
                    class="btn btn-primary form-btn"
                >Employee <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('backend.employees.table')
                </div>
            </div>
        </div>

    </section>
@endsection
