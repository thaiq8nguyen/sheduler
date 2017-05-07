@extends('layouts.main')
@section('content')
    <div class = "container">
        <div class = "row">
            <div class = "col-md-12">
                <h1>Calendar</h1>
                <form role = "form" method = "post" action = "/appointments">
                    {{ csrf_field() }}
                        <div class = "form-group">
                            <div class = "row">
                                <div class = "col-md-2">
                                    <label for = "appointment">Select Date:</label>
                                </div>
                                <div class = "col-md-2">
                                    <input type = "text" id = "appointment-date" name = "appointment-date" class = "form-control">
                                </div>
                            </div>
                        </div>
                        <div class = "form-group">
                            <div class = "row">
                                <div class = "col-md-2">
                                    <label for = "service">Service Appointment:</label>
                                </div>
                                <div class = "col-md-2">
                                    <input type = "text" id = "service" name = "service" class = "form-control">
                                </div>
                            </div>
                        </div>
                        <button type = "submit" class = "btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

@endsection