@extends('backend.layouts.app')

@section('title')
    Customer Creation
@endsection

@section('content')
    <section class="section">
        
        <div class="section-header">
            <h1>Customer List</h1>
            <div class="section-header-breadcrumb">
               
                <a
                    href="{{ route('admin.customers.create') }}"
                    class="btn btn-primary form-btn"
                >Create Customers <i class="fas fa-plus"></i></a>
            </div>
        </div>
      

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('backend.customers.table')
                </div>
            </div>
        </div>

    </section>
@endsection
