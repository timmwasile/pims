@extends('backend.layouts.app')

@section('title')
    Payslips
@endsection

@section('content')
    <section class="section">
        
        <div class="section-header">
            <h1>Payslips </h1>
                   </div>
        <div class="section-body">
            <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body ">
                                {!! Form::open(['route' => 'admin.payslips.filter']) !!}
                                <div class="row">
                                    @include('backend.payslips.payslip_creation_fields')
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
                    @include('backend.payslips.table')
                </div>
            </div>
        </div>

    </section>
@endsection
