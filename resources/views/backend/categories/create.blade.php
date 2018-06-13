@extends('layouts.master')
@section('title')
    <title>Category</title>
@endsection
@section('content')
    <div class="row">
        <div class="offset-2 col-lg-8">
            <br>
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4>Add Category</h4>
                </div>
                <div class="card-body">
                    {{ Form::open(['url' => 'categories']) }}
                    <div class="form-group">
                        {{ Form::label('name', 'Category Name') }}
                        {{ Form::text('name', null, [ 'placeholder' => 'Enter Category Name', 'class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    </section>
@endsection