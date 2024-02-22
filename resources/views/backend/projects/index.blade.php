@extends('backend.layouts.app')

@section('title')
    List of Project(s)
@endsection

@section('content')
    <section class="section">

        <div class="section-header">
            <h1>List of Project(s)</h1>
            <div class="section-header-breadcrumb">

                <a
                    href="{{ route('admin.projects.create') }}"
                    class="btn btn-primary form-btn"
                >Create Project <i class="fas fa-plus"></i></a>
            </div>
        </div>


        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('backend.projects.table')
                </div>
            </div>
        </div>

    </section>
@endsection
