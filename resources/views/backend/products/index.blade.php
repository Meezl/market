@extends('layouts.master')
@section('title')
    <title>Products</title>
@endsection()
@section('content')
<section>
    <div class="container-fluid">
        <div class="row" style="padding-top: 15px;">
            <div class="col-lg-12 col-md-8 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Products</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Town</th>
                                    <th>Description</th>
                                    <th>Country</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category['name'] }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->town }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->country['name'] }}</td>
                                    <td><a href="{{ URL::to('products/'.$product->id.'/edit') }}" class="btn btn-warning pull-left">Edit</a>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['products.destroy', $product->id] ]) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection