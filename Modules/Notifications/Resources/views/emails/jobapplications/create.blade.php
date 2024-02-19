@extends('notifications::layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>{{ ucwords($jobapplication->jobpost->title) }} Application Job </h3>
            </div>

            <div class="col-12">

                <p>
                    Dear <span class="strong">
                        {{ ucwords($jobapplication->name) }}
                    </span>
                </p>
                <p>
                    You have successfully applied for <strong>
                        {{ ucwords($jobapplication->jobpost->title) }} </strong> on
                    {{ $jobapplication->created_at }} with <span class="strong">application number
                        {{ $jobapplication->application_no }}.</span>
                    <span class="strong"> You will be notified for further processes.
                    </span>
                </p>
                <p>
                    <strong>Use this default username and password to view your application status:-</strong>
                </p>
                <p>
                    Username: {{ $jobapplication->email }}
                </p>
                <p>
                    Password: password
                </p>
                <p>
                    To view more details about click <a href="{{ url('/') }}" target="_blank">HERE</a>
                </p>

                <p>
                    DO NOT REPLY TO THIS MAIL.
                </p>
                <p>
                    THIS IS AN AUTOMATED MAIL DELIVERY FROM TANESCO RECRUITMENT PORTAL (TANREP)
                </p>
            </div>
        </div>
    </div>
@endsection
