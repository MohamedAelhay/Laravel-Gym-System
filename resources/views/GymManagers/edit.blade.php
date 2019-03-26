@extends('admin')


@section('content')

    <form action="{{route('GymManagers.update',$gymManager->id)}}" method="post" enctype="multipart/form-data" style="margin-left: 20px">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label" >Name</label>
            <input type="text" name="name" class="form-control col-3" value="{{$gymManager->name}}">
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
            <label for="email" class="col-sm-2 col-form-label" >Email</label>
            <input type="email" name="email"  class="form-control col-3" value="{{$gymManager->email}}">
            @if ($errors->get('email'))
                <div class="alert alert-danger col-sm-6" style="margin-left: 20px; margin-top: 10px;" >
                    <ul>
                        @foreach ($errors->get('email') as $email)
                            <li>{{ $email }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="form-group row">
            <label for="password" class="col-sm-2 col-form-label" >Password</label>
            <input type="password" name="password"  class="form-control col-3" value="******">
            @if ($errors->get('password'))
                <div class="alert alert-danger col-sm-6" style="margin-left: 20px; margin-top: 10px;" >
                    <ul>
                        @foreach ($errors->get('password') as $password)
                            <li>{{ $password }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="form-group row">
            <label for="national_id" class="col-sm-2 col-form-label" >National ID</label>
            <input type="text" name="national_id"  class="form-control col-3" value="{{$gymManager->role->national_id}}">
            @if ($errors->get('national_id'))
                <div class="alert alert-danger col-sm-6" style="margin-left: 20px; margin-top: 10px;" >
                    <ul>
                        @foreach ($errors->get('national_id') as $national_id)
                            <li>{{ $national_id }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="form-group row">
            <label for="img" class="col-sm-2 col-form-label" >Img</label>
            <div class="col">
                @if(Storage::disk('public')->has($gymManager->name.'-'.$authUser->name.'.jpg'))
                    <img src="{{asset('storage/'.$gymManager->name.'-'.$authUser->name.'.jpg')}}"
                         style="width: 200px; height: 200px;" class="img-fluid" alt="Responsive image">
                @endif
            </div>
            <input type="file" name="img" class="form-control col-3">
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
        <div class="form-group row">
            <label for="gym_id" class="col-sm-2 col-form-label">Gyms</label>
            <select class="form-control col-4"  name="gym_id">
                @foreach($gyms as $gym)
                    <option value="{{$gym->id}}" >{{$gym->name}}</option>
                @endforeach
            </select>
            @if ($errors->get('gym_id'))
                <div class="alert alert-danger col-sm-6" style="margin-left: 20px; margin-top: 10px;" >
                    <ul>
                        @foreach ($errors->get('gym_id') as $gym_id)
                            <li>{{ $gym_id }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection
