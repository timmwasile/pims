@extends('backend.layouts.app')

@section('title')
    Create gender
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading m-0">New gender</h3>
            <div class="filter-container section-header-breadcrumb row justify-content-md-end">
                <a
                    href="{{ route('admin.genders.index') }}"
                    class="btn btn-primary"
                >Back</a>
            </div>
        </div>
        <div class="content">
            @include('stisla-templates::common.errors')
            <div class="section-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body ">
                                {!! Form::open(['route' => 'admin.genders.store']) !!}
                                <div class="row">
                                    @include('backend.genders.fields')
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
