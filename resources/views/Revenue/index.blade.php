@extends('admin')
@section('PageHeader')
<h1>
    Revenue
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

    <div class="alert alert-success alert-block">
    @hasrole('city-manager')
    <center><h3>Total {{$city->name}} City revenue : {{$revenue}}</h3><center>
    @endhasrole
    @hasrole('gym-manager')
    <center><h3>Total {{$gym->name}} Gym revenue : {{$revenue}}</h3><center>
    @endhasrole
    @hasrole('super-admin')
    <center><h3>Total revenue : {{$revenue}}</h3><center>
    @endhasrole
</div>


</section>

    </body>

</html>
    @endsection
