@extends('admin')

@section('content')

    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">City manager name</th>
            <th scope="col">country name</th>
           
        </tr>
        </thead>
        <tbody>
            
        <tr>
            <td>{{$city->name}}</td>
            <td>{{$cityManagerInfo->name}}</td>
            <td>{{$countryInfo->name}}</td>
           
        </tr>
        </tbody>
    </table>
@endsection
