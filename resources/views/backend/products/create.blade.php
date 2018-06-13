@extends('layouts.master')
@section('title')
    <title>Products</title>
@endsection()
@section('content')
    <div class="row">
        <div class="offset-2 col-lg-8">
            <br>
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4>Add Product</h4>
                </div>
                <div class="card-body">
                    {{ Form::open(['url' => 'products', "enctype" =>"multipart/form-data"]) }}
                    <div class="form-group">
                        {{ Form::label('name', 'Product Name') }}
                        {{ Form::text('name', null, [ 'placeholder' => 'Enter Product Name', 'class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('category', 'Product Category') }}
                        <select name="category" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"> {{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        {{ Form::label('price', 'Price') }}
                        {{ Form::text('price', null, [ 'placeholder' => 'Enter Price of Product', 'class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('country', "Country") }}
                        <select name="country" class="form-control">
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}"> {{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        {{ Form::label('town', "Town you're in") }}
                        {{ Form::text('town', null, [ 'placeholder' => 'Enter Town Name', 'class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('category', 'Product Category') }}
                        {!! Form::file('image', ['multiple' => false, 'class' => "form-control", 'required' => 'required']) !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label('description', 'Product Description') }}
                        {{ Form::textarea('description', null, ['class' => 'form-control', 'id' => 'description']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection