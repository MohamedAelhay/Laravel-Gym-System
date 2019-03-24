
@extends('admin')


@section('content')

<form action="{{route('AssignCoach.store')}}" method="POST">
        @csrf
    
         <div class="form-group">
            <label for="session_id">Session</label>
            <select class="form-control" name="session_id">
                @foreach($session as $session)
                    <option value="{{$session->id}}">{{$session->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="coach_id">Coach</label>
            <select class="form-control" name="coach_id">
                @foreach($coach as $coach)
                    <option value="{{$coach->id}}">{{$coach->name}}</option>
                @endforeach
            </select>
        </div>
       
       

    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="/assign" class="table-edit btn btn-warning">Back</a>
    </form>
@endsection