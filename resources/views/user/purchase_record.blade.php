@extends('layouts.master')

@section('header')
<div class="container-fluid">
        <div class="row">
                <div class="col-sm-3 mt-3">
                </div>
                <div class="col-sm-6 mt-3">
                        <h3 class="d-flex justify-content-center text-primary fw-bold">{{Auth::user()->name}}'s Purchase Record</h3>
                </div>
                <div class="col-sm-3 mt-3">
                </div>
        </div>
</div> 
@stop

@section('content')
<div id="app"> 
      
</div>
@stop