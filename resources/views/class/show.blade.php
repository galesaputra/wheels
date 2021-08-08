@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.upload.title')</h3>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.view')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr><th>@lang('quickadmin.upload.fields.title')</th>
                    <td>{{ $topic->title }}</td></tr>
                    </table>
                <table class="table table-bordered table-striped {{ count($klass) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th>ID</th>
                        <th>Nama</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($klass) > 0)
                        @foreach ($klass as $klas)
                            <tr data-entry-id="{{ $klas->users_id }}">
                                <td></td>
                                <td>{{ $klas->users_id }}</td>
                                <td>{{ $klas->nama }}</td>
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

            <p>&nbsp;</p>

            <a href="{{ route('topics.index') }}" class="btn btn-default">@lang('quickadmin.back_to_list')</a>
        </div>
    </div>
@stop