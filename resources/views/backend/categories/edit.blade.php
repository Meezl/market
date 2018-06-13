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
                    <h4>Edit Category</h4>
                </div>
                <div class="card-body">
                    {{ Form::model($category, array('route' => array('$category.update', $category->id), 'method' => 'PUT')) }}
                    <div class="form-group">
                        {{ Form::label('name', 'Category Name') }}
                        {{ Form::text('name', $category->name, [ 'placeholder' => 'Enter Category Name', 'class' => 'form-control']) }}
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