@extends('admin')


@section('content')
<a href="{{route('Coaches.index')}}" class="btn btn-danger">Back</a>
    <form action="{{route('Coaches.store')}}" method="POST" style="margin-left: 20px">
        @csrf
        <div class="form-group row">
                <label for="coach name" class="col-sm-2 col-form-label" >coach name</label>
                <input type="text" name="coach name" class="form-control col-3" placeholder="coach name">
            </div>

            {{-- <div class="form-group row">
                <label for="gym name" class="col-sm-2 col-form-label" >gym name</label>
                <input type="text" name="gym name" class="form-control col-3" placeholder="gym name">
            </div> --}}

            

            <div class="form-group">
                <label for="exampleInputPassword1">Gym Name</label>
                <select class="form-control" name="gym name">
                     @foreach($gyms as $gym) 
                <option value="{{$gym->id}}">{{$gym->name}}</option>
                    @endforeach
                </select>
            </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection
