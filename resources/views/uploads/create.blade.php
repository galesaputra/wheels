@extends('layouts.app')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <h3 class="page-title">@lang('quickadmin.uploads.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['uploads.store'], 'files' => true]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            Form Tambah
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    <input type="hidden" name="user_id" id="user_id" value="{{auth()->user()->id}}"/>
                    {!! Form::label('keterangan', 'Keterangan*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('keterangan', old('keterangan'), ['class' => 'form-control ', 'placeholder' => '', 'id' => 'KeteranganData']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('keterangan'))
                        <p class="help-block">
                            {{ $errors->first('keterangan') }}
                        </p>
                    @endif

                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type='file' id="file" name='files' class="form-control">
                <!-- Error -->
                <div class='alert alert-danger mt-2 d-none text-danger' id="err_file"></div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop
@section('javascript')
    <script>

        $(function () {
            var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

            $('#submit').click(function () {

                // Get the selected file
                var keterangan = $('#KeteranganData').val();
                var user_id = $('#user_id').val();
                var files = $('#file')[0].files;

                if (files.length > 0) {
                    var fd = new FormData();

                    // Append data
                    fd.append('files', files[0]);
                    fd.append('_token', CSRF_TOKEN);
                    fd.append('keterangan', keterangan);
                    fd.append('user_id', user_id);

                    // Hide alert
                    $('#responseMsg').hide();

                    // AJAX request
                    $.ajax({
                        url: "{{route('uploads.store')}}",
                        method: 'post',
                        data: fd,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function (response) {

                            // Hide error container
                            $('#err_file').removeClass('d-block');
                            $('#err_file').addClass('d-none');

                            if (response.success == 1) { // Uploaded successfully

                                // Response message
                                $('#responseMsg').removeClass("alert-danger");
                                $('#responseMsg').addClass("alert-success");
                                $('#responseMsg').html(response.message);
                                $('#responseMsg').show();

                                // File preview
                                $('#filepreview').show();
                                $('#filepreview img,#filepreview a').hide();
                                if (response.extension == 'jpg' || response.extension == 'jpeg' || response.extension == 'png') {

                                    $('#filepreview img').attr('src', response.filepath);
                                    $('#filepreview img').show();
                                } else {
                                    $('#filepreview a').attr('href', response.filepath).show();
                                    $('#filepreview a').show();
                                }
                            } else if (response.success == 2) { // File not uploaded

                                // Response message
                                $('#responseMsg').removeClass("alert-success");
                                $('#responseMsg').addClass("alert-danger");
                                $('#responseMsg').html(response.message);
                                $('#responseMsg').show();
                            } else {
                                // Display Error
                                $('#err_file').text(response.error);
                                $('#err_file').removeClass('d-none');
                                $('#err_file').addClass('d-block');
                            }
                        },
                        error: function (response) {
                            console.log("error : " + JSON.stringify(response));
                        }
                    });
                } else {
                    alert("Please select a file.");
                }

            });
        })
    </script>
@endsection

