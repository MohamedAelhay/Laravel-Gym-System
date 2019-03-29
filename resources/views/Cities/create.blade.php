@extends('admin')

@section('content')

<a href="{{route('Cities.index')}}" class="btn btn-danger">Back</a>
    <form action="{{route('Cities.store')}}" method="POST" style="margin-left: 20px">
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
                <label for="name" class="col-sm-2 col-form-label" >city name</label>
                <input type="text" name="name" class="form-control col-3" placeholder="city name">
            </div>

            <div class="form-group">
                    <label for="exampleInputPassword1">City Manager Name</label>
                    
                    <select class="form-control" name="city_manager_id">
                        @foreach($cities as $city)
                            <option value="{{$city->id}}">{{$city->cityManager->user[0]->name}}</option>
                        @endforeach
                    </select>
                    <div class="form-group">
                            <label for="exampleInputPassword1">Country</label>
                            <select class="form-control" name="country_id">
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                    </select>
                    </div>
            </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection
