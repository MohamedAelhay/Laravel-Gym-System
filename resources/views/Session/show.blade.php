
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
                                <th>Start at</th>
                                <th>Ends at</th>
                                <th>Date</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>  
                                <td>{{$session->name}}</td>
                                <td>{{$gym->name}}</td>
                                <td>{{\Carbon\Carbon::createFromFormat('H:i:s',$session->starts_at)->format('g:i A')}}</td>
                                <td>{{\Carbon\Carbon::createFromFormat('H:i:s',$session->finishes_at)->format('g:i A')}}</td>
                                <td>{{\Carbon\Carbon::createFromFormat('Y-m-d',$session->session_date)->format('d-M-Y')}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection