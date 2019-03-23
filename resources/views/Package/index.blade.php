@extends('admin')
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

            <table class="table table-bordered" id="table">

            <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Name</th>
            <th class="text-center">Gym</th>
            <th class="text-center">No of Sessions</th>
            <th class="text-center">Price ($)</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
           
        </tr>
    </tbody>
</table>

        </div>

        <script src="//code.jquery.com/jquery.js"></script>
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

        <script>

$(function() {

            $('#table').DataTable({

                processing: true,

                serverSide: true,

                ajax: '{!! route('get.data') !!}',

                columns: [

                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'gym.name', name: 'gym.name' },
                    { data: 'number_of_sessions', name: 'number_of_sessions' },
                    { data: 'price', name: 'price' }

                ]

            });

        });

        </script>

        @stack('scripts')

    </body>

</html>
    @endsection
