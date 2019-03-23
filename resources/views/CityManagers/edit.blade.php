@extends('admin')


@section('content')

<a href="{{route('CityManagers.index')}}" class="btn btn-danger">Back</a>

 <form action="{{route('CityManagers.update',$Mgr->national_id)}}" method="POST">
    @csrf
    @method('put')

    <div class="form-group">
        <label for="exampleInputId">National_ID</label>
        <input name="id" value="{{$Mgr->national_id}}" type="text" class="form-control" id="exampleInputId" aria-describedby="emailHelp" placeholder="Enter Title">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">name</label>
        <textarea name="name" class="form-control">{{$Mgr->user->name}}</textarea>
    </div>
    
    <div class="form-group">
         <label for="exampleInputPassword1">email</label>
         <textarea name="email" class="form-control">{{$Mgr->user->email}}</textarea>
     </div>

      
    <div class="form-group">
     <label for="exampleInputPassword1">password</label>
     <textarea name="password" class="form-control">{{$Mgr->user->password}}</textarea>
 </div>

 <div class="form-group">
     <label for="exampleInputPassword1">image</label>
     <img src="{{$Mgr->user->image}}">
 </div>
<button type="submit" class="btn btn-primary">Update</button>
</form>
    
@endsection





