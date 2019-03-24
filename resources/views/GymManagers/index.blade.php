@extends('admin')

@section('content')
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">National_ID</th>
            <th scope="col">name</th>
            <th scope="col">email</th>
            <th scope="col">Action<th>
        </tr>
        </thead>
        <tbody>
        @foreach($gymManagers as $gymManager)
            <tr>
                <th scope="row">{{$gymManager->national_id}}</th>
                <td>{{$gymManager->user[0]->name}}</td>
                <td>{{$gymManager->user[0]->email}}</td>
                <td>
                    <a href="{{route('GymManagers.show',$gym->id)}}"><i class="fas fa-eye"></i></a> |
                    <a href="{{route('GymManagers.edit',$gym->id)}}" ><i class="fas fa-pen"></i></a>  |
                    <a href="#" data-toggle="modal" data-target="#myModal"><i class="fas fa-trash-alt"></i></a>
                </td>
        @endforeach
        </tbody>
    </table>
    <a class="btn btn-primary btn-lg col-4" href="{{route('GymManagers.create')}}" style="margin-bottom: 20px; margin-left: 30%;">Create Post</a>
@endsection
