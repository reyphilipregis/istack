@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading" style='font-weight:bold;'>Welcome {{ Auth::user()->name }}!</div>

                <div class="panel-body">
                    
                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-left">
                                <h2> View Template</h2>
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-primary" href="{{ route('home.index') }}"> Back</a>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Name:</strong>
                                {{ $item->name }}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Message:</strong>
                                {{ $item->message }}
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
