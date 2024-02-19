@extends('backend.layouts.app')

@section('title')
    Salary Creation
@endsection

@section('content')
    <section class="section">
        
        <div class="section-header">
            <h1>Salary Creation</h1>
            <div class="section-header-breadcrumb">
               
                <a
                    href="{{ route('admin.salaries.create') }}"
                    class="btn btn-primary form-btn"
                >Create Payslip <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body ">
                                {!! Form::open(['route' => 'admin.salaries.store']) !!}
                                <div class="row">
                                    @include('backend.salaries.salary_creation_fields')
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('backend.salaries.table')
                </div>
            </div>
        </div>

    </section>
@endsection
