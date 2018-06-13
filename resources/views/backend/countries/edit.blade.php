@extends('layouts.master')
@section('title')
    <title>Country </title>
@endsection
@section('content')
    <div class="row">
        <div class="offset-2 col-lg-8">
            <br>
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4>Edit Country</h4>
                </div>
                <div class="card-body">
                    {{ Form::model($country, array('route' => array('countries.update', $country->id), 'method' => 'PUT')) }}
                    <div class="form-group">
                        {{ Form::label('name', 'Country Name') }}
                        {{ Form::text('name', $country->name, [ 'placeholder' => 'Enter Country Name', 'class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection