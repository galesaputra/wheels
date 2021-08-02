@extends('layouts.app')

@section('javascript_head')
@endsection
@section('content')

    <div class="content">

        <div class="col-md-3">
            <form action="#" class="invoice-repeater">
                <div data-repeater-list="invoice">
                    <div data-repeater-item>
                    <div class="row">
                    <div class="col-md-9">
                        <div class="mb-1">
                            <label for="name">Data</label>
                            <input
                                    name="data"
                                    type="text"
                                    class="form-control"
                                    id="name"
                                    aria-describedby="name"
                                    placeholder="Data"
                            />
                        </div>
                    </div>
                        <div class="col-md-3">
                        <button type="button" class="btn btn-outline-danger" data-repeater-delete style="margin-top: 22px;">
                            <i data-feather="x" class="me-25"></i>
                            <span>Hapus</span>
                        </button>
                        </div>
                    </div>
                    </div>
                </div>
                <button type="button" class="btn btn-icon btn-warning" data-repeater-create>
                    <i data-feather="plus" class="me-25"></i>
                    <span>Tambah</span>
                </button>
            </form>

        </div>


    </div>
@endsection
@section('javascript')
    <script type="text/javascript" src="./repeater.js"></script>

    <script>
        $('.invoice-repeater, .repeater-default').repeater({
            show: function () {
                $(this).slideDown();
                // Feather Icons
            },
            hide: function (deleteElement) {
                if (confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                }
            }
        });
    </script>
@endsection
