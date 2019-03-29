@extends('admin')


@section('content')

@if(count($errors))
<ul class="alert alert-danger">
    @foreach($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach
</ul>
@endif


<a href="{{route('Coaches.index')}}" class="btn btn-danger">Back</a>
    <form action="{{route('Coaches.store')}}" method="POST" style="margin-left: 20px">
        @csrf


        <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label" >coach name</label>
                <input type="text" name="name" class="form-control col-3" placeholder="coach name">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Gym Name</label>
                <select class="form-control" name="gym_id">
                     @foreach($gyms as $gym) 
                <option value="{{$gym->id}}">{{$gym->name}}</option>
                    @endforeach
                </select>
            </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection
