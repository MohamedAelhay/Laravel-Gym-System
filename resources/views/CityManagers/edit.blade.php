@extends('admin')


@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<a href="{{route('CityManagers.index')}}" class="btn btn-danger">Back</a>

 <form action="{{route('CityManagers.update',$cityManager->id)}}" method="POST">
    @csrf
    @method('put')

    <div class="form-group">
        <label for="national_id">National_ID</label>
        <input name="national_id" value="{{$cityManager->role->national_id}}" type="text" class="form-control" id="national_id" aria-describedby="emailHelp" placeholder="Enter Title">
    </div>
    <div class="form-group">
        <label for="name">name</label>
        <input name="name" class="form-control" value="{{$cityManager->name}}">
    </div>
    
    <div class="form-group">
         <label for="email">email</label>
         <input name="email" class="form-control" value="{{$cityManager->email}}">
     </div>

      
    <div class="form-group">
     <label for="password">password</label>
     <input name="password" type="password" class="form-control" value="{{$cityManager->password}}">
 </div>

 <div class="form-group">
     <label for="exampleInputPassword1">image</label>
     <img src="{{$cityManager->image}}">
 </div>
<button type="submit" class="btn btn-primary">Update</button>
</form>
    
@endsection





