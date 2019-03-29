
@extends('admin')
@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Gym</th>
                                <th>No of Sessions</th>
                                <th>Price $</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>{{$package->name}}</td>
                                <td>{{$gym->name}}</td>
                                <td>{{$package->number_of_sessions}}</td>
                                <td>{{$price}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
