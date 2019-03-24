@extends('admin')
@section('PageHeader')
<h1>
    City Manager
    <small>Optional description</small>
</h1>
@endsection

@section('content')
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">National_ID</th>
            <th scope="col">name</th>
            <th scope="col">email</th>
            <th scope="col">password</th>
            <th scope="col">image</th>
            <th scope="col">Action<th> 
        </tr>
        </thead>
        <tbody>
        @foreach($cityManagers as $cityManager)
            <tr>
               
                <td>{{$cityManager->national_id}}</td>
                <td>{{$cityManager->user[0]->name}}</td>
                <td>{{$cityManager->user[0]->email}}</td>
                <td>{{$cityManager->user[0]->password}}</td>
                <td>{{$cityManager->user[0]->image}}</td>
                
                   


                    <td><a href="{{route('CityManagers.show',$cityManager->user[0]->id)}} " class="btn btn-primary btn-lg col-4">show </a></td>
                    <td><a href="{{route('CityManagers.edit',$cityManager->user[0]->id)}} " class="btn btn-success">Edit </a></td>

                    <td><form action="{{route('CityManagers.destroy',$cityManager->id)}}" method="POST">
                            @csrf
                            @method('delete')
                          
                    {{-- <a onclick="return myFunction();" href="{{route('CityManagers.destroy',$Mgr->national_id)}}" data-toggle="modal" data-target="#myModal"><i class="fas fa-trash-alt"></i></a> --}}
                        
                          <button type="submit" class="btn btn-danger" onclick="return myFunction();">delete</button>
                          <script>
                              function myFunction() {
                                  if(!confirm("Are You Sure to delete this"))
                                  event.preventDefault();
                                
                              }
                            </script>
                          </form> 
                </td>
        @endforeach
        </tbody>
    </table>
    <a class="btn btn-primary btn-lg col-4" href="{{route('CityManagers.create',$cityManager->user[0]->id)}}" style="margin-bottom: 20px; margin-left: 30%;">Create CityManager</a>
@endsection
