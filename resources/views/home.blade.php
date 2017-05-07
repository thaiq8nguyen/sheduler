@extends('layouts.main')
@push('styles')
    <link rel = "stylesheet" href = "{{ asset('css/home.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
@endpush
@section('content')
    <div class = "bg">
        <div class = "container">
            <div class = "row">
                <div class = "col-sm-8 col-sm-offset-2 top-content">
                    <h1><strong>Sugar Nails</strong> Appointments</h1>
                    <p>Make your appointment today!</p>
                </div>
            </div>
            <div class = "row">
                <div class = "col-sm-6 col-md-offset-3">
                    <div class = "login-container">
                        <a href = "{{ url('/appointments/create') }}" class = "btn btn-primary" id = "make-appointment-btn"><i class="fa fa-calendar pull-left fa-lg"></i>Make Appointments</a>
                        <a href = "tel:+18187541182" class = "btn btn-primary" id = "contact-btn"><i class = "fa fa-phone pull-left fa-lg"></i>Call Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection



