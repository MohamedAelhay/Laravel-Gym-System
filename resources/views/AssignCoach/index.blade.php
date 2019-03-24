@extends('admin')
@section('PageHeader')
<h1>
    Coaches
    <small>Optional description</small>
</h1>
@endsection
@section('content')
<!DOCTYPE html>

<html lang="en">

    <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    </head>

    <body>

    <section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                   <center> <a href='/assign/create' style="margin-top: 10px;" class="btn btn-success">Assign Coach</a></center>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="table" class="table text-center">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Coach</th>
                                <th class="text-center">Session</th>
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

        <script>

$(function() {

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


                ajax: '{!! route('get.assigned') !!}',

                columns: [

                    { data: 'id', name: 'id' },
                    { data: 'coach.name', name: 'coach.name' },
                    { data: 'session.name', name: 'session.name' },
            
            ],
        });

       
       
    });

        </script>

        @stack('scripts')

    </body>

</html>
    @endsection
