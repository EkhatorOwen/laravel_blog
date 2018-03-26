@extends('main')
@section('stylesheets')
    {{Html::style('css/open-iconic-master/font/css/open-iconic-bootstrap.css')}}
@endsection
@section('title','| Delete Blog Post')

@section('content')

   <div class="row">
       <div class="col-md-8 col-md-offset-2">
           <h1>DELETE THIS COMMENT?</h1>
           <P>
               <strong>Name:</strong>{{$comment->name}}
           </P>
           <P>
               <strong>Email:</strong>{{$comment->email}}
           </P>
           <P>
               <strong>Comment:</strong>{{$comment->comment}}
           </P>

           {{Form::open(['route'=>['comments.destroy',$comment->id],'method'=>'DELETE'])}}
           {{Form::submit('YES DELETE THIS COMMENT',['class'=>'btn btn-block btn-danger'])}}
           {{Form::close()}}
       </div>
   </div>


    @endsection()