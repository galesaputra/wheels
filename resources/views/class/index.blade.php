@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.topics.title')</h3>

    <!-- <p>
        <a href="{{ route('topics.create') }}" class="btn btn-success">@lang('quickadmin.add_new')</a>
    </p> -->

    <div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Daftar Course</h4>
            <!-- <p class="card-category"> Daftar Nama Dosen</p> -->    
          </div>
          <div class="card-body">
            <div class="table-responsive">
            
            <table class="table table-bordered table-striped {{ count($topics) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th>@lang('quickadmin.topics.fields.title')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($topics) > 0)
                        @foreach ($topics as $topic)
                            <tr data-entry-id="{{ $topic->id }}">
                                <td></td>
                                <td>{{ $topic->title }}</td>
                                <td>
                                    
                                    <a href="{{ route('class.edit',[$topic->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.edit')</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.are_you_sure")."');",
                                        'route' => ['topics.destroy', $topic->id])) !!}
                                    {!! Form::submit(trans('quickadmin.delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
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