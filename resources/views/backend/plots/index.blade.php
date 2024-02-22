@extends('backend.layouts.app')

@section('title')
   List of Plot
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>List of Plot(s)</h1>
            <div class="section-header-breadcrumb">
                <a
                    href="{{ route('admin.plots.create') }}"
                    class="btn btn-primary form-btn"
                >Create Plot  <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('backend.plots.table')
                </div>
            </div>
        </div>

    </section>
@endsection
