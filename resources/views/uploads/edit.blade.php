@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.questions.title')</h3>
    
    {!! Form::model($uploads, ['method' => 'PUT', 'route' => ['uploads.update', $uploads->id], 'files' => true]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            Form Edit
        </div>

        <div class="panel-body">
            <input type="hidden" name="id" id="id" value="{{$uploads->id}}">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('keterangan', 'Code snippet', ['class' => 'control-label']) !!}
                    {!! Form::textarea('keterangan', old('keterangan'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('keterangan'))
                        <p class="help-block">
                            {{ $errors->first('keterangan') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type='file' id="file" name='files' class="form-control">
                <!-- Error -->
                <div class='alert alert-danger mt-2 d-none text-danger' id="err_file"></div>
            </div>
            </div>

        </div>
    </div>

    {!! Form::submit(trans('quickadmin.update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

