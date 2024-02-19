@extends('backend.layouts.app')

@section('title')
    deductions
@endsection

@section('content')
    <section class="section">
        
        <div class="section-header">
            <h1>deductions</h1>
            <div class="section-header-breadcrumb">
               {{-- <a
                    href="{{ route('admin.salaries.index') }}"
                    class="btn btn-primary form-btn"
                >Make Salary<i class="fas fa-plus"></i></a>
                &nbsp;
                &nbsp; --}}
                <a
                    href="{{ route('admin.deductions.create') }}"
                    class="btn btn-primary form-btn"
                >deduction <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('backend.deductions.table')
                </div>
            </div>
        </div>

    </section>
@endsection
