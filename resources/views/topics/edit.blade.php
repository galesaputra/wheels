@extends('layouts.app')

@section('content')
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!--     <link rel="stylesheet" href="./Tagging/css/amsify.suggestags.css">
    <script src="./Tagging/js/jquery.amsify.suggestags.js"></script> -->
    <!-- <script  type="text/javascript" src="{{ URL::asset('typeahead/typeahead.bundle.js') }}"></script> -->
    
<!--     <script type="text/javascript" src="http://code.jquery.com/jquery-3.0.0.min.js"></script> -->

    <!-- <script type="text/javascript" src="//netsh.pp.ua/upwork-demo/1/js/typeahead.js"></script> -->
    
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" /> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script> -->

    <h3 class="page-title">@lang('quickadmin.topics.title')</h3>
    
    {!! Form::model($topic, ['method' => 'PUT', 'route' => ['topics.update', $topic->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title', 'Topik*', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

