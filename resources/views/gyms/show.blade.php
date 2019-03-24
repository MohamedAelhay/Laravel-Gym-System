@extends('admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>{{$gym->name}}</h1>
            </div>
            <div class="col">
                @if(Storage::disk('public')->has($gym->name.'-'.$user->name.'.jpg'))
                    <img src="{{asset('storage/'.$gym->name.'-'.$user->name.'.jpg')}}" style="width: 200px; height: 200px;" class="img-fluid" alt="Responsive image">
                @endif
            </div>
        </div>
    </div>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Created At</th>
            <th scope="col">Creator</th>
            <th scope="col">City</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{$gym->name}}</td>
            <td>{{$gym->created_at}}</td>
            <td>{{$gym->creator_name}}</td>
            <td>{{$gym->city->name}}</td>
        </tr>
        </tbody>
    </table>
@endsection
