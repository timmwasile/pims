@extends('backend.layouts.app')

@section('title')
    Create Employee
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading m-0">New Employee</h3>
            <div class="filter-container section-header-breadcrumb row justify-content-md-end">
                <a
                    href="{{ route('admin.employees.index') }}"
                    class="btn btn-primary"
                >Back</a>
            </div>
        </div>
        <div class="content">
            @include('stisla-templates::common.errors')
            <div class="section-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body ">
                                {!! Form::open(['route' => 'admin.employees.store']) !!}
                                <div class="row">
                                    @include('backend.employees.fields')
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
