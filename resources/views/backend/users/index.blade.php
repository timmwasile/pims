@extends('backend.layouts.app')

@section('title')
    User
@endsection

@section('content')
    <section class="section">
<div class="section-header">
            <h1>Users</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary form-btn">Users <i
                        class="fas fa-plus"></i></a>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('backend.users.table')
                </div>
            </div>
        </div>

    </section>
@endsection
