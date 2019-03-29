@extends('admin')
@section('content')
<a href="{{route('CityManagers.index')}}" class="btn btn-danger">Back</a>
    <form action="{{route('CityManagers.store')}}" method="POST" style="margin-left: 20px">
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
        <div class="form-group row">
                <label for="National_ID" class="col-sm-2 col-form-label" >National_ID</label>
                <input type="text" name="national_id" class="form-control col-3" placeholder="National_ID" value="{{old('national_id')}}">
            </div>

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label" >name</label>
                <input type="text" name="name" class="form-control col-3" placeholder="name" value={{old('name')}}>
            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label" >email</label>
                <input type="text" name="email" class="form-control col-3" placeholder="email" value={{old('email')}}>
            </div>

            <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label" >password</label>
                <input type="text" name="password" class="form-control col-3" placeholder="password" value={{old('passsword')}}>
            </div>
           
            <div class="form-group row">
                <label for="image" class="col-sm-2 col-form-label" >image</label>
                <input type="file" name="img" class="form-control col-3">
            </div>

        <div class="form-group row">
            <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">Asign to city</label>
            <select class="form-control col-4" name="name">
                @foreach($cities as $city)
                    <option value="{{$city->id}}" >{{$city->name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection
