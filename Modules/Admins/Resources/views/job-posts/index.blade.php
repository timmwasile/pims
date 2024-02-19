@extends('admins::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module for job posts: {!! config('admins.name') !!}
    </p>
@endsection
