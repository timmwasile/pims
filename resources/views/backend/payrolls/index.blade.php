@extends('backend.layouts.app')

@section('title')
    Master File
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Master File</h1>
            
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('backend.payrolls.table')
                </div>
            </div>
        </div>

    </section>
@endsection
