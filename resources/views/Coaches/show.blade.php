@extends('admin')

@section('content')
<a href="{{route('Coaches.index')}}" class="btn btn-danger">Back</a>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Coach Id</th>
            <th scope="col">Coach Name</th>
            <th scope="col">Gym Name</th>
           
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{$coach->id}}</td>
            <td>{{$coach->name}}</td>
            <td>{{$coach->gym->name}}</td>
            
        </tr>
        </tbody>
    </table>
@endsection
