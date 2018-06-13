@extends('layouts.master')
@section('title', '| Products')
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
                        {{ Form::select('category', [ 1 => 'Dairy', 2 => 'Husbandry%'] , null ,[ 'placeholder' => 'Select Category...', 'class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('price', 'Price') }}
                        {{ Form::text('price', null, [ 'placeholder' => 'Enter Price of Product', 'class' => 'form-control']) }}
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
                        {{ Form::submit('Create', array('class' => 'btn btn-primary')) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    </section>
@endsection