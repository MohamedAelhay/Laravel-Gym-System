@extends('admin')
@section('PageHeader')
    <h1>
        Gym-Managers
    </h1>
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
                        <center> <a href='{{route('GymManagers.create')}}' style="margin-top: 10px;" class="btn btn-success">
                                Create Gym Manager</a></center>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="table" class="table text-center">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">User Id</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">National Id</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Banned At</th>
                                <th class="text-center">Show</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Delete</th>
                                <th class="text-center">Ban</th>
                                <th class="text-center">UnBan</th>
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
                        <h3 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this Gym Manager</h3>
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

        <div class="modal fade" id="banpopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Are you sure you want to Ban this Gym Manager</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <div>
                            <div id="csrf_value"  hidden >@csrf</div>
                            {{--@method('DELETE')--}}
                            <button type="button" row_ban="" id="ban-gym-manager"  class="btn btn-danger" data-dismiss="modal">Yes</button>
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


                ajax: '{!! route('GymManagers.data') !!}',

                columns: [

                    { data: 'id', name: 'id' },
                    { data: 'user.id', name: 'user.id' },
                    { data: 'user.name', name: 'user.name' },
                    { data: 'national_id', name: 'national_id' },
                    { data: 'user.email', name: 'user.email' },
                    { data: 'user.banned_at', name: 'banned_at' },
                    /* Show */ {
                        mRender: function (data, type, row) {
                            return '<center><a href="/GymManagers/'+row.user.id+'" class="table-delete btn btn-info" data-id="' + row.id + '">Show</a></center>'
                        }
                    },
                    /* EDIT */ {
                        mRender: function (data, type, row) {
                            return '<center><a href="/GymManagers/'+row.user.id+'/edit" class="table-edit btn btn-warning" data-id="' + row.id + '">Edit</a></center>'
                        }
                    },

                    /* DELETE */ {
                        mRender: function (data, type, row) {
                            return '<center><a href="#" class="table-delete btn btn-danger" row_id="' + row.user.id + '" data-toggle="modal" data-target="#deletepopup" id="delete_toggle">Delete</a></center>'
                        }
                    },
                    /* Ban */
                    {
                        mRender: function (data, type, row) {
                            return '<center><a href="#" class="table-delete btn btn-warning" row_id="' + row.user.id + '" data-toggle="modal" data-target="#banpopup" id="ban_toggle">Ban</a></center>'
                        }
                    },
                    /* UnBan */
                    {
                        mRender: function (data, type, row) {
                            return '<center><a href="#" class="table-delete btn btn-success" row_id="' + row.user.id + '" data-toggle="modal" data-target="#unbanpopup" id="unban_toggle">UnBan</a></center>'
                        }
                    },

                ],
            });

            $(document).on('click','#delete_toggle',function () {
                var delete_id = $(this).attr('row_id');
                $('#delete_item').attr('row_delete',delete_id);
            });


            $(document).on('click','#delete_item',function () {
                var gymManagerId = $(this).attr('row_delete');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/GymManagers/'+gymManagerId,
                    type: 'DELETE',
                    success: function (data) {
                        console.log('success');
                        console.log(data);
                        var table = $('#table').DataTable();
                        table.ajax.reload();
                    },
                    error: function (response) {
                        alert(' error');
                        console.log(response);
                    }
                });

            });

            $(document).on('click','#ban_toggle',function () {
                var ban_id = $(this).attr('row_id');
                $('#ban-gym-manager').attr('row_ban',ban_id);
            });
            $(document).on('click','#ban-gym-manager',function () {
                var gymManagerId = $(this).attr('row_ban');
                console.log(gymManagerId);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/GymManagers/'+gymManagerId+'/ban',
                    type: 'GET',
                    success: function (data) {
                        console.log('success');
                        console.log(data);
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
