@extends('admin')


@section('content')

    <form action="{{route('gyms.store')}}" method="post" enctype="multipart/form-data" style="margin-left: 20px">
        @csrf
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label" >Name</label>
            <input type="text" name="name" class="form-control col-3" placeholder="Gym Name">
            @if ($errors->get('name'))
                <div class="alert alert-danger col-sm-6" style="margin-left: 20px" >
                    <ul>
                        @foreach ($errors->get('name') as $name)
                            <li>{{ $name }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="form-group row">
            <label for="creator_name" class="col-sm-2 col-form-label" >Creator Name</label>
            <input type="text" name="creator_name"  class="form-control col-3" value="{{$userName}}">
        </div>
        <div class="form-group row">
            <label for="img" class="col-sm-2 col-form-label" >Img</label>
            <input type="file" name="img" class="form-control col-3">
            @if ($errors->get('img'))
                <div class="alert alert-danger col-sm-6" style="margin-left: 20px" >
                    <ul>
                        @foreach ($errors->get('img') as $img)
                            <li>{{ $img }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="form-group row">
            <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">City</label>
            <select class="form-control col-4"  name="city_id">
                @foreach($cities as $city)
                    <option value="{{$city->id}}" >{{$city->name}}</option>
                @endforeach
            </select>
            @if ($errors->get('city_id'))
                <div class="alert alert-danger col-sm-6" style="margin-left: 20px" >
                    <ul>
                        @foreach ($errors->get('city_id') as $city_id)
                            <li>{{ $city_id }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection
