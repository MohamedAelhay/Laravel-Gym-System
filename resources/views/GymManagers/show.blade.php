@extends('admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>{{$gymManager->name}}</h1>
            </div>
            <div class="col">
                @if(Storage::disk('public')->has($gymManager->name.'-'.$authUser->name.'.jpg'))
                    <img src="{{asset('storage/'.$gymManager->name.'-'.$authUser->name.'.jpg')}}" style="width: 200px; height: 200px;" class="img-fluid" alt="Responsive image">
                @endif
            </div>
        </div>
    </div>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">National_ID</th>
            <th scope="col">name</th>
            <th scope="col">email</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{$gymManager->role->national_id}}</td>
            <td>{{$gymManager->name}}</td>
            <td>{{$gymManager->email}}</td>
        </tr>
        </tbody>
    </table>
@endsection
