@extends('admin')
@section('PageHeader')
<h1>
    Gyms
    <small>Optional description</small>
</h1>
@endsection

@section('content')
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Creator</th>
            <th scope="col">Created At</th>
            <th scope="col">City Name</th>
        </tr>
        </thead>
        <tbody>
        @foreach($gyms as $gym)
            <tr>
                <th scope="row">{{$gym->id}}</th>
                <td>{{$gym->name}}</td>
                <td>{{$gym->creator_name}}</td>
                <td>{{$gym->created_at}}</td>
                <td>{{$gym->city->name}}</td>
                <td>
                    <a href="{{route('gyms.show',$gym->id)}}"><i class="fas fa-eye"></i></a> |
                    <a href="{{route('gyms.edit',$gym->id)}}" ><i class="fas fa-pen"></i></a>  |
                    <a href="#" data-toggle="modal" data-target="#myModal"><i class="fas fa-trash-alt"></i></a>
                </td>
        @endforeach
        </tbody>
    </table>
    <a class="btn btn-primary btn-lg col-4" href="{{route('gyms.create')}}" style="margin-bottom: 20px; margin-left: 30%;">Create Post</a>
@endsection
