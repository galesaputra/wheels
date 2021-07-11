@extends('layouts.app')

@section('content')
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link href="../select2/select2.min.css" rel="stylesheet" />
    <script src="../select2/select2.min.js"></script>
    <h3 class="page-title">@lang('quickadmin.topics.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['topics.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title', 'Title*', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '']) !!}

                    <!-- {!! Form::label('Nama Mahasiswa', 'Nama Mahasiswa*', ['class' => 'control-label']) !!}
                    {!! Form::hidden('idMahasiswa', old('idMahasiswa'), ['class' => 'form-control', 'placeholder' => '', 'id' => 'idMahasiswa']) !!}
                    {!! Form::text('NamaMahasiswa', old('NamaMahasiswa'), ['class' => 'form-control', 'placeholder' => '', 'id' => 'NamaMahasiswa']) !!} -->
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
            </div>
            <!-- <table class="table table-bordered table-striped {{ count($users) > 0 ? 'datatable' : '' }} dt-select">
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
                                    <a style="display: block;" id="pilih{{$user->id}}" href="javascript:pilih({{$user->id}}, '{{$user->name}}');">Pilih</a>
                                    <a style="display: none;" id="hapus{{$user->id}}" href="javascript:hapus({{$user->id}}, '{{$user->name}}');">Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">@lang('quickadmin.no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table> -->
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
    <script>
        function pilih(id, nama){
            var ambilId = document.getElementById('idMahasiswa').value;
            var ambilNama = document.getElementById('NamaMahasiswa').value;
            var idElemenPilih = "pilih"+id;
            var idElemenHapus = "hapus"+id;
            document.getElementById('idMahasiswa').value = ambilId + id + ",";
            document.getElementById('NamaMahasiswa').value = ambilNama + nama + ",";
            document.getElementById(idElemenPilih).style.display = "none";
            document.getElementById(idElemenHapus).style.display = "block";
        }
        function hapus(id, nama){
            var ambilId = document.getElementById('idMahasiswa').value;
            var ambilNama = document.getElementById('NamaMahasiswa').value;
            var idElemenPilih = "pilih"+id;
            var idElemenHapus = "hapus"+id;
            var hapusId = ambilId.replace(id+',','');
            var hapusNama = ambilNama.replace(nama+',','');
            document.getElementById('idMahasiswa').value = hapusId;
            document.getElementById('NamaMahasiswa').value = hapusNama;
            document.getElementById(idElemenPilih).style.display = "block";
            document.getElementById(idElemenHapus).style.display = "none";
        }
    </script>
@endsection

