@extends('admin')
@section('PageHeader')
<h1>
    Packages
    <small>Optional description</small>
</h1>
@endsection
@section('content')
<!DOCTYPE html>

<html lang="en">

    <head>

<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">


    </head>

    <body>

    <section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                   <center> <a href='/package/create' style="margin-top: 10px;" class="btn btn-success">Create Package</a></center>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Gym</th>
                                <th class="text-center">No of Sessions</th>
                                <th class="text-center">Price ($)</th>
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
</section>

        <script src="//code.jquery.com/jquery.js"></script>
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

        <script>

$(function() {

            $('#table').DataTable({

                processing: true,

                serverSide: true,
                'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,

                ajax: '{!! route('get.data') !!}',

                columns: [

                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'gym.name', name: 'gym.name' },
                    { data: 'number_of_sessions', name: 'number_of_sessions' },
                    { data: 'price', name: 'price' },
/* Show */ {
    mRender: function (data, type, row) {
                        return '<center><a href="/package/'+row.id+'" class="table-delete btn btn-info" data-id="' + row.id + '">Show</a></center>'
                    }
                },
                /* EDIT */ {
                    mRender: function (data, type, row) {
                        return '<center><a href="/package/edit/'+row.id+'" class="table-edit btn btn-warning" data-id="' + row.id + '">EDIT</a></center>'
                    }
                },
                /* DELETE */ {
                    mRender: function (data, type, row) {
                        return '<center><a href="#" class="table-delete btn btn-danger" row_id="' + row.id + '" data-toggle="modal" data-target="#DeleteModal" id="delete_toggle">DELETE</a></center>'
                    }
                }
            ],
        });
        });

        </script>

        @stack('scripts')

    </body>

</html>
    @endsection
