{{-- 

 
 
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
                        <td>{{$cityManager->user[0]['image']}}</td> 
                        <td><a href="{{route('CityManagers.show',$cityManager->user[0]->id)}} " class="btn btn-primary btn-lg col-4">show </a></td> 
                        <td><a href="{{route('CityManagers.edit',$cityManager->user[0]->id)}} " class="btn btn-success">Edit </a></td> 
                        <td><form action="{{route('CityManagers.destroy',$cityManager->user[0]->id)}}" method="POST">
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
              
                @endforeach   
        </tbody>
    </table>
    <a class="btn btn-primary btn-lg col-4" href="{{route('CityManagers.create')}}" style="margin-bottom: 20px; margin-left: 30%;">Create CityManager</a>
   
   
@endsection  --}}




@extends('admin')
@section('PageHeader')
<h1>
    city manager
    <small>Optional description</small>
</h1>
@endsection
@section('content')
<!DOCTYPE html>

<html lang="en">

    <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    </head>

    <body>

    <section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                   <center> <a href="{{route('CityManagers.create')}}" style="margin-top: 10px;" class="btn btn-success">Add City Manager</a></center>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="CityManagers"  class="table text-center">
                        <thead>
                            <tr>
                               
                                <th class="text-center">Id</th>
                             
                                <th class="text-center">User Id</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">National Id</th>
                                <th class="text-center">Email</th>
                                {{-- <th class="text-center">Banned At</th> --}}
                                <th class="text-center">Show</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Delete</th>
                                {{-- <th class="text-center">Ban</th>
                                <th class="text-center">UnBan</th> --}}
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deletepopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this Package</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <div>
                        <div id="csrf_value"  hidden >@csrf</div>
                        {{--@method('DELETE')--}}
                        <button type="button" row_delete="" id="delete_item"  class="btn btn-danger" data-dismiss="modal">Yes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

</section>

<script src="//code.jquery.com/jquery.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

        <script>

 $(function() {

            $('table').DataTable({

                processing: true,

                serverSide: true,
                'paging'      : true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : true,
                "bLengthChange": true,
                'autoWidth'   : true,


                ajax: '{!! route('get.cityManagers') !!}',

                columns: [
                    { data: 'id', name: 'id' },
                { data: 'user.id', name: 'user.id' },
                { data: 'user.name', name: 'user.name' },
                { data: 'national_id', name: 'national_id' },
                { data: 'user.email', name: 'user.email' },
                    // { data: 'user.banned_at', name: 'banned_at' },
                 
                    

/* Show */ {
    mRender: function (data, type, row) {
                        return '<center><a href="/cityManagers/'+row.id+'" class="table-delete btn btn-info" data-id="' + row.id + '">Show</a></center>'
                    }
                },
                /* EDIT */ {
                    mRender: function (data, type, row) {
                        return '<center><a href="/cityManagers/'+row.id+'/edit" class="table-edit btn btn-warning" data-id="' + row.id + '">Edit</a></center>'
                    }
                },

                /* DELETE */ {
                    mRender: function (data, type, row) {
                        return '<center><a href="#" class="table-delete btn btn-danger" row_id="' + row.id + '" data-toggle="modal" data-target="#deletepopup" id="delete_toggle">Delete</a></center>'
                    }
                },
            
            ],
        });

        $(document).on('click','#delete_toggle',function () {
            var delete_id = $(this).attr('row_id');
            $('#delete_item').attr('row_delete',delete_id);
        });
        
        $(document).on('click','#delete_item',function () {
            var cityManagers_id = $(this).attr('row_delete');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/cityManagers/'+cityManagers_id,
                type: 'DELETE',
                success: function (data) {
                    console.log('success');
                    console.log(data);
                    var table = $('table').DataTable();
                    table.ajax.reload();
                },
                error: function (response) {
                    alert(' error');
                    console.log(response);
                }
            });

        });
       
    });

        </script>

        @stack('scripts')

    </body>

</html>
    @endsection
























