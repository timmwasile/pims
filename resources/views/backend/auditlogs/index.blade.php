@extends('backend.layouts.app')

@section('title')
    Audit Logs
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Audit Logs</h1>

        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('backend.auditlogs.table')
                </div>
            </div>
        </div>

    </section>
@endsection
