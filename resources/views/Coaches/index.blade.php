@extends('admin')

@section('content')
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">National_ID</th>
            <th scope="col">name</th>
            <th scope="col">email</th>
            <th scope="col">Action<th>
        </tr>
        </thead>
        <tbody>
        @foreach($coaches as $coach)
            <tr>
                <th scope="row">{{$coach->national_id}}</th>
                <td>{{$coach->user[0]->name}}</td>
                <td>{{$coach->user[0]->email}}</td>
                <td>

                        <td><a href="{{route('Coaches.show',$coach->user[0]->id)}} " class="btn btn-primary btn-lg col-4">show </a></td>
                        <td><a href="{{route('Coaches.edit',$coach->user[0]->id)}} " class="btn btn-success">Edit </a></td>

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
    <a class="btn btn-primary btn-lg col-4" href="{{route('Coaches.create')}}" style="margin-bottom: 20px; margin-left: 30%;">Create Post</a>
@endsection
