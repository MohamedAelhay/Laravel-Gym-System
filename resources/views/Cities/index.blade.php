@extends('admin')
@section('PageHeader')
<h1>
    City 
    <small>Optional description</small>
</h1>
@endsection

@section('content')
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">name</th>
            <th scope="col">country id</th>
            <th scope="col">city manager id</th>
            <th scope="col">city manager name></th>
        </tr>
        </thead>
        <tbody>
        

        @foreach($cities as $city)
            <tr>
               
                <td>{{$city->name}}</td>
                <td>{{$city->city_manager_id}}</td>
                <td>{{$city->country_id}}</td>
            
             
                
                   
                    <td><a href="{{route('Cities.show',$city->id)}} " class="btn btn-primary btn-lg col-4">show </a></td>
                    {{-- <td><a href="{{route('Cities.edit')}} " class="btn btn-success">Edit </a></td> --}} 

                    {{-- <td><form action="{{route('Cities.destroy')}}" method="POST">
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
                </td> --}}
        @endforeach
        </tbody>
    </table>
    {{-- <a class="btn btn-primary btn-lg col-4" href="{{route('Cities.create')}}" style="margin-bottom: 20px; margin-left: 30%;">Create CityManager</a> --}}
@endsection
