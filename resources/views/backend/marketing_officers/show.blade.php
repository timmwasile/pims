@extends('backend.layouts.app')

@section('title')
    Marketing Officer Details
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Marketing Officer Details</h1>
            <div class="section-header-breadcrumb">
                <a
                    href="{{ route('admin.marketing_officers.index') }}"
                    class="btn btn-primary form-btn float-right"
                >Back</a>
            </div>
        </div>
        @include('stisla-templates::common.errors')
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('backend.marketing_officers.show_fields')
                </div>
            </div>
        </div>
    </section>
@endsection
