@extends('backend.layouts.app')

@section('title')
    Admins
@endsection

@section('content')

    <section class="section">

        <div class="section-header">
            <h1>User List</h1>
            <div class="section-header-breadcrumb">
@can('admin_create')

                <a href="{{ route('admin.admins.create') }}" class="btn btn-primary form-btn">User <i
                        class="fas fa-plus"></i></a>
@endcan

            </div>
        </div>

        <div class="section-body">
                <div class="card">
                <div class="card-body">
                    @include('backend.admins.table')
                </div>
            </div>
        </div>

    </section>
@endsection
