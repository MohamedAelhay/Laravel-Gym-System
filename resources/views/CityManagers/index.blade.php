@extends('admin')


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
        @foreach($cityMgrs as $Mgr)
            <tr>
               
                <td>{{$Mgr->national_id}}</td>
                <td>{{$Mgr->user->name}}</td>
                <td>{{$Mgr->user->email}}</td>
                <td>{{$Mgr->user->password}}</td>
                <td>{{$Mgr->user->image}}</td>
                
                    {{-- <a href="{{route('CityManagers.show',$Mgr->national_id)}}"><i class="fas fa-eye"></i></a> |
                    <a href="{{route('CityManagers.edit',$Mgr->national_id)}}" ><i class="fas fa-pen"></i></a>  | --}}
                    <td><a href="{{route('CityManagers.edit',$Mgr->national_id)}} " class="btn btn-primary btn-lg col-4">show </a></td>
                    <td><a href="{{route('CityManagers.edit',$Mgr->national_id)}} " class="btn btn-success">Edit </a></td>

                    <td><form action="{{route('CityManagers.destroy',$Mgr->national_id)}}" method="POST">
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
    <a class="btn btn-primary btn-lg col-4" href="{{route('CityManagers.create')}}" style="margin-bottom: 20px; margin-left: 30%;">Create CityManager</a>
@endsection
