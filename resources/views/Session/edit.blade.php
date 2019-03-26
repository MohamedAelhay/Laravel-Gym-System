@extends('admin')
@section('style')
<link rel="stylesheet" href="{{ asset('plugins/timepicker/bootstrap-timepicker.min.css')}}">
<link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<link rel="stylesheet" href="../../bower_components/select2/dist/css/select2.min.css">
@endsection
@section('content')
<br>
<div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Edit session</h3>
            </div>
            <div class="box-body">
            <form action="{!! route('Session.update',['session'=>$session->id]) !!}" method="POST">
        @method('PUT')
                @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" value="{{$session->name}}"disabled>
            </div>

            <div class="bootstrap-timepicker">
                <div class="form-group">
                    <label>Starts at:</label>

                    <div class="input-group">
                    <input type="text" class="form-control timepicker" name="starts_at" value="{{date('H:i', strtotime($session->starts_at))}}">

                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                    </div>
                    <!-- /.input group -->
                </div>
                <!-- /.form group -->
            </div>
            @if ($errors->has('starts_at'))
    <div class="alert alert-danger" style="margin: 4px;">
        <ul style="list-style: none;">
                <li>{{ $errors->first('starts_at')}}</li>
        </ul>
    </div>
    <br>
    @endif

            <div class="bootstrap-timepicker">
                <div class="form-group">
                    <label>Ends at:</label>

                    <div class="input-group">
                    <input type="text" class="form-control timepicker" name="finishes_at" value="{{date('H:i', strtotime($session->finishes_at))}}">
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                    </div>
                </div>
            </div>
            @if ($errors->has('finishes_at'))
    <div class="alert alert-danger" style="margin: 4px;">
        <ul style="list-style: none;">
                <li>{{ $errors->first('finishes_at')}}</li>
        </ul>
    </div>
    <br>
    @endif

            <div class="form-group">
                <label>Date:</label>

                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="datepicker" value="{{$session->session_date}}" name="session_date">
                </div>
                <!-- /.input group -->
            </div>
            @if ($errors->has('session_date'))
    <div class="alert alert-danger" style="margin: 4px;">
        <ul style="list-style: none;">
                <li>{{ $errors->first('session_date')}}</li>
        </ul>
    </div>
    <br>
    @endif

            <div class="form-group">
            <label for="gym_id">Gym</label>
            <select class="form-control" name="gym_id" readonly>
                    <option value="{{$gym->id}}">{{$gym->name}}</option>
            </select>
        </div>

        <div class="form-group">
                <div class="form-group">
                    <label>Coaches</label>
                @foreach($coaches as $coach)
                <li>{{$coach->name}}</li>
                @endforeach
                    </div>
                </div>
            </div>


            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>

            
          </div>

    @endsection

    @section('plugins')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="{{ asset('plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="../../bower_components/select2/dist/js/select2.full.min.js"></script>
@endsection

@section('script')
<script>
    $(function () {
        //Date picker
        $('#datepicker').datepicker({
            format: "yy-mm-dd",
            autoclose: true
        })
        //Timepicker
        $('.timepicker').timepicker({
            showMeridian: false,   
            showInputs: false
        })
    })
</script>
@endsection