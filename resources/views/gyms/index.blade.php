@extends('admin')
@section('PageHeader')
    <h1>
        Gyms
        <small>Optional description</small>
    </h1>
    @include('flash-message')

@endsection
@section('content')
    <!DOCTYPE html>

    <html lang="en">

    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">

    <body>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <center> <a href='{{route('gyms.create')}}' style="margin-top: 10px;" class="btn btn-success">Create Gym</a></center>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="table" class="table text-center">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Creator</th>
                                <th class="text-center">Created At</th>
                                <th class="text-center">City Name</th>
                                <th class="text-center">Show</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Delete</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deletepopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this Gym</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <div>
                            <div id="csrf_value"  hidden >@csrf</div>
                            {{--@method('DELETE')--}}
                            <button type="button" row_delete="" id="delete_item"  class="btn btn-danger" data-dismiss="modal">Yes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>

    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <script>
        // let $  = require( 'jquery' );
        // var dt = require( 'datatables.net' )();

        $(document).ready(function() {

            $('#table').DataTable({

                processing: true,

                serverSide: true,
                'paging'      : true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : true,
                "bLengthChange": true,
                'autoWidth'   : true,


                ajax: '{!! route('gyms.data') !!}',

                columns: [

                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'creator_name', name: 'creator_name' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'city.name', name: 'city.name' },
                    /* Show */ {
                        mRender: function (data, type, row) {
                            return '<center><a href="/gyms/'+row.id+'" class="table-delete btn btn-info" data-id="' + row.id + '">Show</a></center>'
                        }
                    },
                    /* EDIT */ {
                        mRender: function (data, type, row) {
                            return '<center><a href="/gyms/'+row.id+'/edit" class="table-edit btn btn-warning" data-id="' + row.id + '">Edit</a></center>'
                        }
                    },

                    /* DELETE */ {
                        mRender: function (data, type, row) {
                            return '<center><a href="#" class="table-delete btn btn-danger" row_id="' + row.id + '" data-toggle="modal" data-target="#deletepopup" id="delete_toggle">Delete</a></center>'
                        }
                    },

                ],
            });

            $(document).on('click','#delete_toggle',function () {
                var delete_id = $(this).attr('row_id');
                $('#delete_item').attr('row_delete',delete_id);
            });

            $(document).on('click','#delete_item',function () {
                var gymId = $(this).attr('row_delete');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/gyms/'+gymId,
                    type: 'DELETE',
                    success: function () {
                        alert("Gym has been deleted successfully");
                        var table = $('#table').DataTable();
                        table.ajax.reload();
                    },
                    error: function (response) {
                        alert(' error');
                        console.log(response);
                    }
                });

            });

        });

    </script>

    @stack('scripts')

    </body>

    </html>
@endsection
