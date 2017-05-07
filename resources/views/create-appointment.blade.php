@extends('layouts.main')
@push('styles')
    <link rel = "stylesheet" href = "{{ asset('css/custom.css')}}">
@endpush
@include('partials.header')
@section('content')
    <div class = "header-wrap">
        <div class = "container">
            <div class = "row">
                <h2>Make an Appointment</h2>
            </div>
        </div>
    </div>

    <section class = "container" id = "appointment-date-section">
        <div class = "row">
            <div class = "col-md-12">
                <div class = "panel panel-default">
                    <div class = "panel-heading"><h3 class = "panel-title">1. Choose a date</h3></div>
                    <div class = "panel-body">
                        <form role = "form" id = "date-form">
                            <div class = "form-group">
                                <label for = "calendar"></label>
                                <div class = "input-group">
                                    <input type = "text"  id = "calendar" class = "form-control" placeholder = "Select a date...">
                                    <div class = "input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class = "container" id = "appointment-time-section">
        <div class = "row">
            <div class = "col-md-12">
                <div class = "panel panel-default">
                    <div class = "panel-heading"><h3 class = "panel-title">2. Choose a time</h3></div>
                    <div class = "panel-body" id = "time-slot-container"></div>
                </div>
            </div>
        </div>
    </section>
    <section class = "container" id = "appointment-detail-section">
        <div class = "row">
            <div class = "col-md-12">
                <div class = "panel panel-default">
                    <div class = "panel-heading"><h3 class = "panel-title">3. Select a service </h3></div>
                    <div class = "panel-body">
                        <form role = "form" method = "post" action = " {{ url('/appointments') }}" id = "appointment-form" autocomplete ="off">
                            {{ csrf_field() }}
                            <div class = "row">
                                <div class = "col-md-5"></div>
                                <div class = "col-md-7">
                                    @if($errors->has('appointment-date')) <div class = "alert alert-danger">{{ $errors->first('appointment-date') }}</div> @endif
                                </div>
                            </div>
                            <input type = "hidden" name = "appointment-date" id = "appointment-date">
                            <div class = "form-group @if($errors->has('service')) has-error @endif " >
                                <div class = "row">
                                    <div class = "col-md-5">
                                        <label for = "service">Service (required) : </label>
                                    </div>
                                    <div class = "col-md-7">
                                        <select class = "form-control" id = "service" name = "service">
                                            @foreach($services as $service)
                                                <option>{{$service["name"]}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('service')) <p class = "help-block">{{ $errors->first('service') }}</p> @endif
                                    </div>
                                </div>
                            </div>
                            <div class = "form-group @if ($errors->has('name')) has-error @endif">
                                <div class = "row">
                                    <div class = "col-md-5">
                                        <label for = "name">Your Name (required) : </label>
                                    </div>
                                    <div class = "col-md-7">
                                        <input type = "text" id = "name" name = "name" class = "form-control">
                                        @if ($errors->has('name')) <p class = "help-block"> {{ $errors->first('name') }}</p> @endif
                                    </div>
                                </div>
                            </div>
                            <div class = "form-group @if($errors->has('phone')) has-error @endif" >
                                <div class = "row">
                                    <div class = "col-md-5">
                                        <label for = "phone">Your Phone (required) # : </label>
                                    </div>
                                    <div class = "col-md-7">
                                        <input type = "text" id = "phone" name = "phone" class = "form-control" placeholder ="(area code) phone number">
                                        @if($errors->has('phone')) <p class = "help-block">{{ $errors->first('phone') }}</p> @endif
                                    </div>
                                </div>
                            </div>
                            <div class = "form-group">
                                <div class = "row">
                                    <div class = "col-md-5">
                                        <label for = "customer-notes">Notes:</label>
                                    </div>
                                    <div class = "col-md-7">
                                        <textarea cols = "20" rows = "4" name = "customer-notes" id = "customer-notes" class = "form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type = "submit" class = "btn btn-submit">Book Appointment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>






@endsection