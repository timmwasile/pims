@extends('backend.layouts.app')

@section('title')
    monthlies
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Monthlies</h1>
            <div class="section-header-breadcrumb">
                <a
                    href="{{ route('admin.monthlies.create') }}"
                    class="btn btn-primary form-btn"
                >Monthly Payment<i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('backend.monthlies.table')
                </div>
            </div>
        </div>

    </section>
@endsection
