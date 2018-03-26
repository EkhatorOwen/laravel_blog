@extends('main')
@section('stylesheets')
    {{Html::style('css/open-iconic-master/font/css/open-iconic-bootstrap.css')}}
@endsection
@section('title','| View Blog Post')

@section('content')

    <div class="row">

        <div class="col-8">

            <img src="{{asset('images/'.$post->image)}}" />

            <h1>{{$post->title}}</h1>

            <p class="lead">{!! $post->body!!}</p>

            <hr>

            <div class="tags">

            @foreach($post->tags as $tag)
                <span class="badge bg-info">{{$tag->name}}</span>
                @endforeach
            </div>
                <h3>Comments <small>{{$post->comments()->count()}} total</small> </h3>
        <div id="comment-button">
                <table class="table">
                    <thead>
                    <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Comment</th>
                        <th width="50px"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($post->comments as $comment)
                        <tr>
                    <td>{{$comment->name}}</td>
                    <td>{{$comment->email}}</td>
                    <td>{{$comment->comment}}</td>
                            <td>
                            <a href="{{route('comments.edit',$comment->id)}}" class="btn btn-xs btn-primary"> <span class="oi oi-pencil"></span> </a>
                            <a href="{{route('comments.delete',$comment->id)}}" class="btn btn-xs btn-danger" style="margin-top: 5px"><span class="oi oi-delete"></span></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>

            <div class="col-4">

                    <div class="card" style="width: 18rem;">

                            <div class="card-body">

                                <dl class="dl-horizontal">
                                    <dt>Url Slug: </dt>
                                    <dd><a href=" {{url('blog/'.$post->slug)}}">{{url('blog/'.$post->slug)}}</a> </dd>
                                </dl>

                                <dl class="dl-horizontal">
                                    <dt>Created At: </dt>
                                    <dd>{{date('M j, Y h:ia',strtotime($post->created_at))}} </dd>
                                </dl>

                                <dl class="dl-horizontal">
                                    <dt>Last Updated: </dt>
                                    <dd>{{date('M j, Y h:ia',strtotime($post->updated_at))}} </dd>
                                </dl>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        {!! Html::linkRoute('posts.edit','Edit',array($post->id),array('class'=>'btn btn-primary btn-block')) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::open(['route'=>['posts.destroy',$post->id],'method'=>'DELETE']) !!}
                                        {!!Form::submit('Delete',['class'=>'btn btn-danger btn-block'])  !!}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                        </div>

                        <div class="col-md-12">
                            {{Html::linkRoute('posts.index','<<See All Posts'), [ ],['class'=>'btn btn-default btn-block btn-h1-spacing']}}

                        </div>
                    </div>
            </div>
     </div>

@endsection