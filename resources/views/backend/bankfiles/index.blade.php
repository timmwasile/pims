@extends('backend.layouts.app')

@section('title')
    Payslips
@endsection

@section('content')
    <section class="section">
        
        <div class="section-header">
            <h1>Bank files </h1>
                   </div>
              <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('backend.bankfiles.table')
                </div>
            </div>
        </div>

    </section>
@endsection
