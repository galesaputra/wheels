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
    
    {!! Form::model($topic, ['method' => 'PUT', 'route' => ['class.update', $topic->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title', 'Topik*', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '']) !!}

                    <label class="control-label">Nama Mahasiswa</label>
                    
                    <input type="text" name="nama_mahasiswa" id="NamaMahasiswa" class="form-control" value="<?php echo $nama_users;?>" readonly>
                    <input type="hidden" name="IdMahasiswa" id="IdMahasiswa" class="form-control" value="<?php echo $id_users;?>">
                    <input type="hidden" name="topics_id" id="topics_id" class="form-control" value="<?php echo $id;?>">
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
            </div>
            <table class="table table-bordered table-striped {{ count($users) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th>ID</th>
                        <th>Nama</th>
                        <th></th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($users) > 0)
                        @foreach ($users as $user)
                            <tr data-entry-id="{{ $user->id }}">
                                <td></td>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td> 
                                    <a style="{{$user->pilih}}" id="pilih{{$user->id}}" href="javascript:pilih({{$user->id}}, '{{$user->name}}');">Tambahkan Mahasiswa Ke Topik</a>
                                    <a style="{{$user->hapus}}" id="hapus{{$user->id}}" href="javascript:hapus({{$user->id}}, '{{$user->name}}');">Hapus Mahasiswa Dari Topik</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">@lang('quickadmin.no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop
@section('javascript')
    <script>
        function pilih(id, nama){
            var ambilId = $('#IdMahasiswa').val();
            var ambilNama = $('#NamaMahasiswa').val();
            var idElemenPilih = "pilih"+id;
            var idElemenHapus = "hapus"+id;
            var pecah_ambilId = ambilId.split(",");
            for (var i = 0; i < pecah_ambilId.length; i++) {
                if (pecah_ambilId[i] == id) {
                        document.getElementById(idElemenPilih).style.display = "none";
                        document.getElementById(idElemenHapus).style.display = "block";
                    break;

                        
                }else{
                        $('#IdMahasiswa').val(ambilId + id + ",");
                        $('#NamaMahasiswa').val(ambilNama + nama + ",");
                    document.getElementById(idElemenPilih).style.display = "none";
                    document.getElementById(idElemenHapus).style.display = "block";
                }
            }
        }
        function hapus(id, nama){
            var ambilId = $('#IdMahasiswa').val();
            var ambilNama = $('#NamaMahasiswa').val();
            var idElemenPilih = "pilih"+id;
            var idElemenHapus = "hapus"+id;
            
                var hapusId = ambilId.replace(id+',','');
                var hapusNama = ambilNama.replace(nama+',','');
                $('#IdMahasiswa').val(hapusId);
                // document.getElementById('idMahasiswa').value = hapusId;
                $('#NamaMahasiswa').val(hapusNama);
                // document.getElementById('NamaMahasiswa').value = hapusNama;
                document.getElementById(idElemenPilih).style.display = "block";
                document.getElementById(idElemenHapus).style.display = "none"; 
            
        }
    </script>
@endsection

