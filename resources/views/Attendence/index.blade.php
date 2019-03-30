@extends('admin')
@section('PageHeader')
<h1>
    Attendence
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
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="attendence_table"  class="table text-center">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">User Name</th>
                                <th class="text-center">User Email</th>
                                <th class="text-center">Session Name</th>
                                @hasanyrole('super-admin|city-manager')
                                <th class="text-center">Gym Name</th>
                                @endhasanyrole
                                <th class="text-center">Time</th>
                                <th class="text-center">Date</th>
                                @hasrole('super-admin')
                                <th class="text-center">City Name</th>
                                @endhasrole
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

            $('#attendence_table').DataTable({

                processing: true,

                serverSide: true,
                'paging'      : true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : true,
                "bLengthChange": true,
                'autoWidth'   : true,


                ajax: '{!! route('get.att') !!}',

                columns: [

                    { data: 'id', name: 'id' },
                    { data:'user.name'},
                    { data:'user.email'},
                    { data: 'session.name'},
                    @hasanyrole('super-admin|city-manager')
                    { data:'gym.name'},
                    @endhasanyrole
                    { data: 'attendance_time', name: 'attendance_time' },
                    { data: 'attendance_date', name: 'attendance_date' },
                    @hasrole('super-admin')
                    { data: 'city.name', name: 'city.name' },
                    @endhasrole

            ],
        });
    });


        </script>

        @stack('scripts')

    </body>

</html>
    @endsection
