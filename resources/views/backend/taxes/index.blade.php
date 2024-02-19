@extends('backend.layouts.app')

@section('title')
    Taxes
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Taxes</h1>
            <div class="section-header-breadcrumb">
                <a
                    href="{{ route('admin.taxes.create') }}"
                    class="btn btn-primary form-btn"
                >taxe <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('backend.taxes.table')
                </div>
            </div>
        </div>

    </section>
@endsection
