@extends('main')

@section('title','| View Blog Post')

@section('content')

    <div class="row">

        <div class="col-8">

            <h1>{{$post->title}}</h1>

            <p class="lead">{{$post->body}}</p>

            <hr>

            <div class="tags">

            @foreach($post->tags as $tag)
                <span class="badge bg-info">{{$tag->name}}</span>
                @endforeach
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