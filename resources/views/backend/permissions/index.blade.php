@extends('backend.layouts.app')

@section('title')
    permissions
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Permission</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary form-btn">Permission <i
                        class="fas fa-plus"></i></a>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('backend.permissions.table')
                </div>
            </div>
        </div>

    </section>
@endsection
