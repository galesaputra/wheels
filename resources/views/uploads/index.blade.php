@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.uploads.title')</h3>
    <div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Daftar Upload</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
            <a href="{{ route('uploads.create') }}" class="btn btn-xs btn-primary"> <i class="glyphicon glyphicon-plus"></i> Tambah </a>
            
            <table class="table table-bordered table-striped {{ count($uploads) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th>User</th>
                        <th>Keterangan</th>
                        <th>File</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($uploads) > 0)
                        @foreach ($uploads as $row)
                            <tr data-entry-id="{{ $row->id }}">
                                <td></td>
                                <td>{{ $row->name or '' }}</td>
                                <td>{{ $row->keterangan or '' }}</td>
                                <td><a href="./{{$row->file}}" target="_blank">Lihat File</a> </td>

                                <td>
                                    
                                    <a href="{{ route('uploads.edit',[$row->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.edit')</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.are_you_sure")."');",
                                        'route' => ['uploads.destroy', $row->id])) !!}
                                    {!! Form::submit(trans('quickadmin.delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7">@lang('quickadmin.no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>

            </div>
          </div>
        </div>
      </div>
  
        </div>
      </div>
    </div>
  </div>
</div>
@stop

@section('javascript')
    <script>
        window.route_mass_crud_entries_destroy = '{{ route('topics.mass_destroy') }}';
    </script>
@endsection