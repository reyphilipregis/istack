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
                                <h2>Templates</h2>
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-success" href="{{ route('template.create') }}"> Create New Template</a>
                            </div>
                        </div>
                    </div>

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Message</th>
                            <th width="295px">Action</th>
                        </tr>
                    @foreach ($items as $key => $item)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->message }}</td>
                        <td>
                            <a class="btn btn-info" href="{{ route('template.show',$item->id) }}">View</a>
                            <a class="btn btn-primary" href="{{ route('template.edit',$item->id) }}">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['template.destroy', $item->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'id' => 'delete', 'name' => 'delete']) !!}
                            {!! Form::close() !!}
                            <a class="btn btn-info" href="{{ route('template.generate',$item->id) }}">Generate</a>
                        </td>
                    </tr>
                    @endforeach
                    </table>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
