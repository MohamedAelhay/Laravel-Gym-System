@extends('admin')

@section('content')
<a href="{{route('Cities.index')}} " class="btn btn-primary btn-lg col-4">back </a>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">City Name</th>
            <th scope="col">City manager id</th>
            <th scope="col">country id</th>
           
        </tr>
        </thead>
        <tbody>
            
        <tr>
            <td>{{$city->name}}</td>
            <td>{{$city->city_manager_id}}</td>
            <td>{{$city->country_id}}</td>   
        </tr>
        </tbody>
    </table>
@endsection
