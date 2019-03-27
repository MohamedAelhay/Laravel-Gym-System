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
    <center><h3>Total gym revenue : {{$revenue}}</h3><center></div>

</section>

    </body>

</html>
    @endsection
