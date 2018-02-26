@extends('main')

@section('title','| Edit Blog Post')

@section('stylesheets')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')

    <div class="container">

        <div class="row ">

        <div class="col-8">

            {!! Form::model($post,['route'=>['posts.update',$post->id],'method'=>'PUT']) !!}
            {{Form::label('title','Title:')}}
            {{Form::text('title',null,['class'=>'form-control input-lg'])}}

            {{Form::label('slug','Slug:',['class'=>'form-spacing-top'])}}
            {{Form::text('slug',null,['class'=>'form-control input-lg '])}}

            {{Form::label('category_id','Category:')}}
            {{Form::select('category_id',$categories, null,['class' => 'form-spacing-top form-control'])}}
                <br>
            {{Form::label('tags','Tags:',['class' => 'form-spacing-top '])}}
            {{Form::select('tags[]',$tags, null,['class'=>'select2-multi form-control','multiple'=>'multiple'])}}



            {{Form::label('body','Body:',['class'=>'form-spacing-top'])}}
           {{Form::textarea('body',null,['class'=>'form-control'])}}

        </div>
        <div class="col-4 ">

            <div class="card" style="width: 18rem;">

                <div class="card-body">

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
                        <div class="col">
                            {!! Html::linkRoute('posts.show','Cancel',array($post->id),array('class'=>'btn btn-danger btn-block')) !!}

                        </div>
                        <div class="col">
                            {{Form::submit('Save',['class'=>'btn btn-success btn-block'])}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{Form::close()}}
    </div>
    </div>

@endsection

@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script type="text/javascript">
        $(".select2-multi").select2();
        $(".select2-multi").select2().val({!! $post->tags->pluck('id') !!}).trigger('change');
    </script>
    @endsection