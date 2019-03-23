@extends('admin')


@section('content')

<a href="{{route('CityManagers.index')}}" class="btn btn-danger">Back</a>

 <form action="{{route('CityManagers.update',$Mgr->national_id)}}" method="POST">
    @csrf
    @method('put')

    <div class="form-group">
        <label for="national_id">National_ID</label>
        <input name="national_id" value="{{$Mgr->national_id}}" type="text" class="form-control" id="national_id" aria-describedby="emailHelp" placeholder="Enter Title">
    </div>
    <div class="form-group">
        <label for="name">name</label>
        <input name="name" class="form-control" value="{{$Mgr->user->name}}">
    </div>
    
    <div class="form-group">
         <label for="email">email</label>
         <input name="email" class="form-control" value="{{$Mgr->user->email}}">
     </div>

      
    <div class="form-group">
     <label for="password">password</label>
     <input name="password" class="form-control" value="{{$Mgr->user->password}}">
 </div>

 <div class="form-group">
     <label for="exampleInputPassword1">image</label>
     <img src="{{$Mgr->user->image}}">
 </div>
<button type="submit" class="btn btn-primary">Update</button>
</form>
    
@endsection





