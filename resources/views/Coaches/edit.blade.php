@extends('admin')


@section('content')

<a href="{{route('Coaches.index')}}" class="btn btn-danger">Back</a>

 <form action="{{route('Coaches.update',$coach->id)}}" method="POST">
    @csrf
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @method('put')

    <div class="form-group">
        <label for="coach ID">coach ID</label>
        <input name="coach ID" value="{{$coach->id}}" type="text" class="form-control" id="coach ID" aria-describedby="gym idHelp" placeholder="Enter Title">
    </div>
    <div class="form-group">
        <label for="name">coach name</label>
        <input name="name" class="form-control" value="{{$coach->name}}">
    </div>
    
    {{-- <div class="form-group">
         <label for="gym id">gym id</label>
         <input name="gym id" class="form-control" value="{{$coach->gym_id}}">
     </div>

       
    <div class="form-group">
        <label for="gym Name">gym Name</label>
        <input name="gym Name" type="gym Name" class="form-control" value="{{$coach->gym->name}}">
    </div> --}}
    
    <div class="form-group">
        <label for="exampleInputPassword1">Gym Name</label>
        <select class="form-control" name="gym name">
             @foreach($gyms as $gym) 
        <option value="{{$gym->id}}">{{$gym->name}}</option>
            @endforeach
        </select>
    </div>

    {{-- <div class="form-group">
        <label for="exampleInputPassword1">Post Creator</label>
        <select class="form-control" name="user_id">
            @foreach($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
    </div> --}}

<button type="submit" class="btn btn-primary">Update</button>
</form>
    
@endsection





