@extends('layouts.main')
@push('styles')
    <link rel = "stylesheet" href = "{{ asset('css/confirm.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
@endpush
@section('content')
    <div class = "container">
        <div class = "row">
            <div class = "col-md-6 col-md-offset-3 heading">
                <h1>Thank You!</h1>
            </div>
        </div>
        <div class = "row">
            <div class = "col-md-6 col-md-offset-3">
                <div class = "confirmation-container">
                    <h3>Your appointment is: </h3>
                    <p class = "date">
                        @if(Session::has('appointment-date'))
                            {{Session::get('appointment-date')}}
                        @endif
                    </p>
                    <p class = "customer-note">Please call us at <span>(818) 754-1182</span> if you wish to cancel or reschedule the appointment.</p>
                    <a href = "/" class = "btn btn-primary" id = "btn-home">Home</a>
                </div>
            </div>
        </div>
    </div>
@endsection