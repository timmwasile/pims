@extends('backend.layouts.app')

@section('title')
    Transactions List
@endsection

@section('content')
    <section class="section">

        <div class="section-header">
            <h1>Transactions List</h1>
            <div class="section-header-breadcrumb">
         </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('backend.transactions.table')
                </div>
            </div>
        </div>

    </section>
@endsection
