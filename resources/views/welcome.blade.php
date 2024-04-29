@extends('layouts.master')

@section('header')
<div class="container-fluid">
        <div class="row">
                <div class="col-sm-3 mt-3">
                </div>
                <div class="col-sm-6 mt-3">
                    <h3 class="d-flex justify-content-center text-primary fw-bold">Welcome To ModelMosaic</h3>
                </div>
                <div class="col-sm-3 mt-3">
                </div>
        </div>
</div> 
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            @foreach($items as $item)
                <div class="col-sm-4 mt-3">
                    <a href="{{route('item_detail', $item->id)}}">
                        <img class="img-fluid rounded" src="/images/{{$item->image}}" style="width: 100%; height: 300px;">
                    </a>
                </div>
            @endforeach
        </div>
    </div> 
@stop

