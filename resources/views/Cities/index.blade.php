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
            <th scope="col">City name</th>
            {{-- <th scope="col">country Name</th>
            <th scope="col">city manager Name</th> --}}
            <th scope="col">city manager id</th>
            <th scope="col">country id</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        

        @foreach($cities as $city)
            <tr>
               
                <td>{{$city->name}}</td>
                <td>{{$city->city_manager_id}}</td>
                <td>{{$city->country_id}}</td>
                {{-- <td>{{$countryInfo->name}}</td>
                <td>{{$cityManagerInfo->name}}</td>  --}}
             
                
                   
                    <td><a href="{{route('Cities.show',$city->id)}} " class="btn btn-primary btn-lg col-4">show </a></td>
                    <td><a href="{{route('Cities.edit',$city->id)}} " class="btn btn-success">Edit </a></td> 

                    <td><form action="{{route('Cities.destroy',$city->id)}}" method="POST">
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
            </tr> 
        @endforeach
        </tbody>
    </table>
    <a class="btn btn-primary btn-lg col-4" href="{{route('Cities.create')}}" style="margin-bottom: 20px; margin-left: 30%;">Create City</a>
@endsection
