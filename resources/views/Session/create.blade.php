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
              <h3 class="box-title">Create session</h3>
            </div>
            <div class="box-body">
            <form action="{{route('Session.store')}}" method="POST">
        @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" placeholder="Session Name" name="name">
            </div>
            @if ($errors->has('name'))
    <div class="alert alert-danger" style="margin: 4px;">
        <ul style="list-style: none;">
                <li>{{ $errors->first('name')}}</li>
        </ul>
    </div>
    <br>
    @endif

    <div class="form-group">
                <label>Name</label>
                <input type="text" name="starts_at">
            </div>

            <!-- <div class="bootstrap-timepicker">
                <div class="form-group">
                    <label>Starts at:</label>

                    <div class="input-group">
                        <input type="text" class="form-control timepicker" name="starts_at" placeholder="Session Starts At">

                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                    </div> -->
                    <!-- /.input group -->
                <!-- </div> -->
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
                        <input type="text" class="form-control timepicker" name="finishes_at" placeholder="Session Ends At">

                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                    </div>
                    <!-- /.input group -->
                </div>
                <!-- /.form group -->
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
                    <input type="text" class="form-control pull-right" id="datepicker" placeholder="Session Date" name="session_date">
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
        @if ($errors->has('gym_id'))
    <div class="alert alert-danger" style="margin: 4px;">
        <ul style="list-style: none;">
                <li>{{ $errors->first('gym_id')}}</li>
        </ul>
    </div>
    <br>
    @endif

        <div class="form-group">
                <div class="form-group">
                    <label>Coaches</label>
                    <select id="coaches" class="form-control select2" name="coach_id[]" multiple="multiple"
                        data-placeholder="Select a coach" style="width: 100%;">
                        @foreach($coaches as $coach)
                        <option value="{{$coach->id}}">{{$coach->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            @if ($errors->has('coach_id'))
    <div class="alert alert-danger" style="margin: 4px;">
        <ul style="list-style: none;">
                <li>{{ $errors->first('coach_id')}}</li>
        </ul>
    </div>
    <br>
    @endif


            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" onclick="{alert(document.getElementById('message').value);}" class="btn btn-primary">Submit</button>
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
        //Initialize Select2 Elements
        $('.select2').select2()

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