@extends('layouts.master')
@section('title')
    <title>Categories</title>
@endsection()
@section('content')
    <section>
        <div class="container-fluid">
            <div class="row" style="padding-top: 15px;">
                <div class="col-lg-12 col-md-8 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Categories</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                            <th scope="row">{{ $category->name }}</th>
                                            <td><a href="{{ URL::to('categories/'.$category->id.'/edit') }}" class="btn btn-warning pull-left">Edit</a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['categories.destroy', $category->id] ]) !!}
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