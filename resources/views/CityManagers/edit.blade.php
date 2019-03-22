@extends('admin')


@section('content')
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">National_ID</th>
            <th scope="col">name</th>
            <th scope="col">email</th>
        </tr>
        </thead>
        <tbody>
        @foreach($cityMgrs as $Mgr)
            <tr>
               
                <td>{{$Mgr->national_id}}</td>
                <td>{{$Mgr->user_id->name}}</td>
                <td>{{$Mgr->user_id->email}}</td>

                {{-- <td>
                    <a href="{{route('CityManagers.show',$Mgr->national_id)}}"><i class="fas fa-eye"></i></a> |
                    <a href="{{route('CityManagers.edit',$Mgr->national_id)}}" ><i class="fas fa-pen"></i></a>  |
                    <a href="{{route('CityManagers.destroy',$Mgr->national_id)}}" data-toggle="modal" data-target="#myModal"><i class="fas fa-trash-alt"></i></a>
                </td> --}}
        @endforeach
        </tbody>
    </table>
    <a class="btn btn-primary btn-lg col-4" href="{{route('CityManagers.create')}}" style="margin-bottom: 20px; margin-left: 30%;">Create CityManager</a>
@endsection
