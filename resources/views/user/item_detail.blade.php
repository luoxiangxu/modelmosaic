@extends('layouts.master')

@section('header')
<div class="container-fluid">
        <div class="row">
                <div class="col-sm-3 mt-3">
                </div>
                <div class="col-sm-6 mt-3">
                        <h3 class="d-flex justify-content-center text-primary fw-bold">{{$item->item_name}}'s Detail</h3>
                </div>
                <div class="col-sm-3 mt-3">
                </div>
        </div>
</div> 
@stop

@section('content')
<div class="container-fluid">
        <div class="row">
                <div class="col-sm-3 mt-3">
                </div>
                <div class="col-sm-6 mt-3">
                        <img class="img-fluid rounded" src="/images/{{$item->image}}" style="width: 100%; height: 500px;">
                        <h4 class="card-title">Item Name : {{$item->item_name}}</h4>
                        <p class="card-text mt-3">Item Description : {{$item->description}}</p>
                        <p class="card-text">Price : ${{$item->price}}</p>
                        <p class="card-text">Added Date : {{$item->added_date}}</p>
                        <a href="{{route('stripe', $item)}}">
                                <button type="button" class="btn btn-primary">Buy This Model</button>
                        </a>
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CommentModal">Post Comment</a>
                </div>
                <div class="col-sm-3 mt-3">
                </div>
        </div>
</div> 
@stop

@section('comment')
<div id="app"> 
      <comment />
</div>
@stop