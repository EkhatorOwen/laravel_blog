@extends('main')

@section('title','| All Tags')

@section('stylesheets')
    {!! Html::style('css/parsley.css') !!}
@endsection()

@section('content')

    <div class="row">
        <div class="col-md-8">
            <h1>Tags</h1>
            <table class="table">

                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tags as $tag)
                    <tr>
                        <th>{{$tag->id}}</th>
                        <td><a href="{{route('tags.show',$tag->id)}}" class=" "> {{$tag->name}}</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"> </h5>
                    {{Form::open(['route'=>'tags.store','data-parsley-validate' =>''])}}
                    <p class="card-text">New Tag</p>
                    {{Form::label('name','Name:')}}
                    {{Form::text('name',null,['class'=>'form-control','required'=>''])}}
                    {{Form::submit('Create New Tag',['class'=>'btn btn-primary btn-block btn-h1-spacing'])}}
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection