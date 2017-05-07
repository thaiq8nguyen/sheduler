@extends('layouts.main');
@section('content')
    <div class = "container">
        <div class = "row">
            <div class = "col-md-12">
                <ul>
                    @foreach($events->getItems() as $event)
                        <li> Start: {{$event->start->dateTime}} - Summary: {{ $event->summary }} </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class = "row">
            <div class = "col-md-4">
                <form role = "form" method = "post" action = "/appointments">
                    {{ csrf_field() }}
                    <div class = "form-group">
                        <label for = "appointment-date">Appointment Date:</label>
                        <input class = "form-control" type = "text" name = "appointment-date" id = "appointment-date">
                    </div>
                    <div class = "form-group">
                        <label for = "service">Service:</label>
                        <input class = "form-control" type = "text" name = "service" id = "service">
                    </div>
                    <button type = "submit" class = "btn btn-primary" name = "submit">Book</button>
                </form>
            </div>
        </div>
    </div>
@endsection