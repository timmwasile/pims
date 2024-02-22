@extends('backend.layouts.app')

@section('title')
    farm Creation
@endsection

@section('content')
    <section class="section">

        <div class="section-header">
            <h1>farm Creation</h1>
            <div class="section-header-breadcrumb">

                <a
                    href="{{ route('admin.farms.create') }}"
                    class="btn btn-primary form-btn"
                >Create farm <i class="fas fa-plus"></i></a>
            </div>
        </div>


        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('backend.farms.table')
                </div>
            </div>
        </div>

    </section>
@endsection
