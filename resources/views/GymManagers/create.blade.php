@extends('admin')


@section('content')

    <form action="{{route('GymManagers.store')}}" method="post" enctype="multipart/form-data" style="margin-left: 20px">
        @csrf
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label" >Name</label>
            <input type="text" name="name" class="form-control col-3">
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label" >Email</label>
            <input type="email" name="email"  class="form-control col-3">
        </div>
        <div class="form-group row">
            <label for="password" class="col-sm-2 col-form-label" >Password</label>
            <input type="password" name="password"  class="form-control col-3">
        </div>
        <div class="form-group row">
            <label for="national_id" class="col-sm-2 col-form-label" >National ID</label>
            <input type="text" name="national_id"  class="form-control col-3">
            <input type="hidden" name="role_type"  class="form-control col-3" value="App\GymManager">
        </div>
        <div class="form-group row">
            <label for="img" class="col-sm-2 col-form-label" >Img</label>
            <input type="file" name="img" class="form-control col-3">
        </div>
        <div class="form-group row">
            <label for="gym_id" class="col-sm-2 col-form-label">Gyms</label>
            <select class="form-control col-4"  name="gym_id">
                @foreach($gyms as $gym)
                    <option value="{{$gym->id}}" >{{$gym->name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection
