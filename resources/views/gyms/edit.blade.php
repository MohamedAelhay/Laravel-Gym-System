@extends('admin')


@section('content')

    <form action="{{route('gyms.update',$gym->id)}}" method="post" enctype="multipart/form-data" style="margin-left: 20px">
        @csrf
        @method('PUT')

        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label" >Name</label>
            <input type="text" name="name" class="form-control col-3" placeholder="Gym Name" value="{{$gym->name}}">
            @if ($errors->get('name'))
                <div class="alert alert-danger col-sm-6" style="margin-left: 20px; margin-top: 10px;" >
                    <ul>
                        @foreach ($errors->get('name') as $name)
                            <li>{{ $name }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="form-group row">
            <label for="img" class="col-sm-2 col-form-label" >Img</label>
            @if(Storage::disk('public')->has($gym->name.'-'.$user->name.'.jpg'))
                <img src="{{asset('storage/'.$gym->name.'-'.$user->name.'.jpg')}}" style="width: 200px; height: 200px;" class="img-fluid" alt="Responsive image">
            @endif
            <input type="file" name="img" class="form-control col-3" >
            @if ($errors->get('img'))
                <div class="alert alert-danger col-sm-6" style="margin-left: 20px; margin-top: 10px;" >
                    <ul>
                        @foreach ($errors->get('img') as $img)
                            <li>{{ $img }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        @hasrole('super-admin')
        <div class="form-group row">
            <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">City</label>
            <select class="form-control col-4"  name="city_id">
                @foreach($cities as $city)
                    <option value="{{$city->id}}" >{{$city->name}}</option>
                @endforeach
            </select>
        </div>
        @if ($errors->get('city_id'))
            <div class="alert alert-danger col-sm-6" style="margin-left: 20px; margin-top: 10px;" >
                <ul>
                    @foreach ($errors->get('city_id') as $city_id)
                        <li>{{ $city_id }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @endrole
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection
