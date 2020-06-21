@extends('layouts.admin-master')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Phones</h1>
        <div class="my-2 px-1">
            <div class="row">
                <div class="col-6">
                    <div>
                        <a href="{{route('phones.create')}}" class="btn-primary btn-sm">
                            <i class="fas fa-plus-circle mr-1"></i>
                            Add Phones
                        </a>
                    </div>
                </div>
                <div class="col-6 text-right">
                    <span class="mr-2"><a href="{{route('phones.index')}}">All Phones</a> |</span>
                    <span class="mr-2"><a href="{{route('admin.discountPhones')}}">Discount Phones</a> |</span>
                    <span class="mr-2"><a href="{{route('admin.trash-phones')}}">Trash Phones</a></span>
                </div>
            </div>
        </div>

        @if(isset($discount_phones))
            <div class="alert alert-primary"><strong>{{$discount_phones}}</strong></div>
        @endif
        @include('layouts.includes.flash-message')
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All phones list</h6>
            </div>
            <div class="card-body">
                @if($phones->count())
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Action</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Regular Price</th>
                            <th>Discount</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Action</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Regular Price</th>
                            <th>Discount</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($phones as $book)
                        <tr>
                            <td>
                                {!! Form::open(['method'=>'DELETE', 'action'=>['Admin\AdminBooksController@destroy', $book->id]]) !!}
                                <div class="action d-flex flex-row">
                                    <a href="{{route('phones.edit', $book->id)}}" class="btn-primary btn btn-sm mr-2"><i class="fas fa-edit"></i></a>

                                    <button type="submit" onclick="return confirm('Book will move to trash! Are you sure to delete??')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </div>
                                {!! Form::close() !!}
                            </td>
                            <td><img src="{{$book->image_url}}" width="60" height="70" alt=""></td>
                            <td><a href="{{route('phones.edit', $book->id)}}">{{$book->title}}</a></td>
                            <td>{{$book->category->name}}</td>
                            <td>{{$book->author->name}}</td>
                            <td>{{$book->init_price}}</td>
                            <td>{{$book->discount_rate}}%</td>
                            <td>{{$book->price}}</td>
                            <td>{{$book->quantity}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>

    </div>
@endsection
