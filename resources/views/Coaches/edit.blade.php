@extends('admin')


@section('content')

<a href="{{route('Coaches.index')}}" class="btn btn-danger">Back</a>

 <form action="{{route('Coaches.update',$cityManager->id)}}" method="POST">
    @csrf
    @method('put')

    <div class="form-group">
        <label for="national_id">National_ID</label>
        <input name="national_id" value="{{$coach->role->national_id}}" type="text" class="form-control" id="national_id" aria-describedby="emailHelp" placeholder="Enter Title">
    </div>
    <div class="form-group">
        <label for="name">name</label>
        <input name="name" class="form-control" value="{{$coach->name}}">
    </div>
    
    <div class="form-group">
         <label for="email">email</label>
         <input name="email" class="form-control" value="{{$coach->email}}">
     </div>

      
    <div class="form-group">
     <label for="password">password</label>
     <input name="password" type="password" class="form-control" value="{{$coach->password}}">
 </div>

 <div class="form-group">
     <label for="img">image</label>
     <img src="{{$coach->image}}">
 </div>
<button type="submit" class="btn btn-primary">Update</button>
</form>
    
@endsection





