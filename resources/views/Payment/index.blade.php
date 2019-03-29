@extends('admin')
@section('PageHeader')
<h1>
    Purchase history
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
    <div class="alert alert-alert-block">
    @hasrole('city-manager')
    <center><h3>City: {{$city->name}}</h3><center>
    @endhasrole
    @hasrole('gym-manager')
    <center><h3>Gym: {{$gym->name}}</h3><center>
    @endhasrole
</div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="purchase_table"  class="table text-center">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">User Name</th>
                                <th class="text-center">User Email</th>
                                <th class="text-center">Package Name</th>
                                <th class="text-center">Package Price ($)</th>
                                <th class="text-center">Purchase date</th>
                                @hasanyrole('super-admin|city-manager')
                                <th class="text-center">Gym</th>
                                @endhasanyrole
                                @hasrole('super-admin')
                                <th class="text-center">City</th>
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

            $('#purchase_table').DataTable({

                processing: true,

                serverSide: true,
                'paging'      : true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : true,
                "bLengthChange": true,
                'autoWidth'   : true,


                ajax: '{!! route('get.purchase') !!}',

                columns: [

                    { data: 'id', name: 'id' },
                    { data:'users.name'},
                    { data:'user.email'},
                    { data: 'package_name', name: 'package_name' },
                    { data: 'package_price', name: 'package_price' },
                    { data: 'purchase_date', name: 'purchase_date' },
                    @hasrole('super-admin|city-manager')
                    { data: 'gym.name', name: 'gym.name' },
                    @endhasrole
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
