@extends('admin')
@section('style')
<link rel="stylesheet" href="{{ asset('plugins/timepicker/bootstrap-timepicker.min.css')}}">
<link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
@endsection
@section('content')
@include('flash-message')


        @yield('content')
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

    <!-- <div class="form-group">
                <label>Name</label>
                <input type="text" name="starts_at">
            </div> -->

            <div class="bootstrap-timepicker">
                <div class="form-group">
                    <label>Starts at:</label>

                    <div class="input-group">
                        <input type="text" class="form-control timepicker" name="starts_at" placeholder="Session Starts At">

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
                @hasrole('super-admin')
                <div class="box-body">
                    <div class="form-group">
                        <label>City</label>
                        <select class="form-control dynamic" name="city_id" id="city_id" data-dependent="gym">
                            <option value="">Select City</option>
                            @foreach ($cities as $city)
                                <option value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label>Gym</label>
                        <select class="form-control dynamic" name="gym_id" id="gym" data-dependent="coaches">
                            <option value="">Select Gym </option>
                        </select>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label>Coach</label>
                        <select class="form-control" name="coach_id" id="coaches" multiple="multiple">
                            <option value="">Select Coach </option>
                        </select>
                    </div>
                </div>
                @endrole

                @hasrole('city-manager')
                <div class="box-body">
                <div class="form-group">
                    <label>City</label>
                    <select class="form-control " name="city_id" id="city_id">
                        <option value="">Select City</option>
                            <option selected value="{{$cities->id}}">{{$cities->name}}</option>
                    </select>
                </div>
            </div>
    <div class="box-body">
        <div class="form-group">
            <label>Gym</label>
            <select class="form-control dynamic" name="gym_id" id="gym" data-dependent="coaches">
                @foreach ($gyms as $gym)
                    <option value="{{$gym->id}}">{{$gym->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="box-body">
        <div class="form-group">
            <label>Coach</label>
            <select class="form-control" name="coach_id" id="coaches" >
                <option value="">Select Coach </option>
            </select>
        </div>
    </div>

                @endhasrole




                @hasrole('gym-manager')
                <div class="form-group">
                    <label for="gym_id">Gym</label>
                    <select class="form-control" name="gym_id" readonly>
                        <option value="{{$gyms->id}}">{{$gyms->name}}</option>
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
                @endrole

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" onclick="{alert(document.getElementById('message').value);}" class="btn btn-primary">Submit</button>
            </div>
            </form>


          </div>

    @endsection

    @section('plugins')
        <!-- jQuery 3 -->
        <script src="{{ asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
        <script src="//code.jquery.com/jquery.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

        <!-- bootstrap time picker -->
        <script src="{{ asset('plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
        <!-- bootstrap datepicker -->
        <script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    @endsection

@section('script')
<script>

    $(document).ready(function() {
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
        });

        $('.dynamic').change(function () {
            if ($(this).val() != '') {
                var select = $(this).attr("id");
                var value = $(this).val();
                var dependent = $(this).data('dependent');
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('dynamicdependentSession.fetch') }}",
                    method: "POST",
                    data: {select: select, value: value, _token: _token, dependent: dependent},
                    success: function (result) {
                        console.log(result);
                        $('#' + dependent).html(result);
                    },
                    error: function (respose) {
                        alert(' error');
                        console.log(respose);
                    }
                })
            }
        });

        $('#city_id').change(function(){
            $('#gym').val('');
            $('#coaches').val('');
        });

        $('#gym').change(function(){
            $('#coaches').val('');
        });
    });
</script>
@endsection
