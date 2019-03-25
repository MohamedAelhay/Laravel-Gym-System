@extends('admin')

@section('content')
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Coach ID</th>
            <th scope="col">Coach Name</th>
            <th scope="col">Gym Id</th>
            <th scope="col">Gym Name</th>
            <th scope="col">Actions<th>
        </tr>
        </thead>
        <tbody>
        @foreach($coaches as $coach)
            <tr>
                <th scope="row">{{$coach->id}}</th>
               
                <td>{{$coach->name}}</td>
                <td>{{$coach->gym_id}}</td>
                <td>{{$coach->gym->name}}</td>
                <td>

                        <td><a href="{{route('Coaches.show',$coach->id)}} " class="btn btn-primary btn-lg col-4">show </a></td>
                        <td><a href="{{route('Coaches.edit',$coach->id)}} " class="btn btn-success">Edit </a></td>

                        <td><form action="{{route('Coaches.destroy',$coach->id)}}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger" onclick="return myFunction();">delete</button>
                                <script>
                                  function myFunction() {
                                      if(!confirm("Are You Sure to delete this"))
                                      event.preventDefault();
                                    }
                                </script>
                            </form> 
                        </td>
                    </td>
                </td>
        @endforeach
        </tbody>
    </table>
    <a class="btn btn-primary btn-lg col-4" href="{{route('Coaches.create')}}" style="margin-bottom: 20px; margin-left: 30%;">Add coach</a>
@endsection
