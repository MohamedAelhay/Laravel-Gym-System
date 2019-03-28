@extends('admin')
@section('content')
 <!-- general form elements -->
 @include('flash-message')


        @yield('content')
 <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Buy a package</h3>
    </div>
    <form role="form" method="POST" action="{{route('Payment.store')}}">
        @csrf
        <div class="box-body">
            <div class="form-group">
              <label>Choose a member</label>
              <select class="form-control" name="user_id">
                  @foreach ($users as $user)
                  <option value="{{$user->id}}">{{$user->name}}</option>
                  @endforeach
              </select>
            </div>
        </div>
        @if ($errors->has('user_id'))
    <div class="alert alert-danger" style="margin: 4px;">
        <ul style="list-style: none;">
                <li>{{ $errors->first('user_id')}}</li>
        </ul>
    </div>
    <br>
    @endif

        <div class="box-body">
            <div class="form-group">
              <label>Choose a package</label>
              <select class="form-control" name="package_name">
                    @foreach ($packages as $package)
                    <option value="{{$package->name}}">{{$package->name}}</option>
                    @endforeach
              </select>
            </div>
        </div>
        @if ($errors->has('package_name'))
        <br>
    <div class="alert alert-danger" style="margin: 4px;">
        <ul style="list-style: none;">
                <li>{{ $errors->first('package_name')}}</li>
        </ul>
    </div>
    <br>
    @endif


        <div class="box-body">
            <div class="form-group">
              <label>Choose a Gym</label>

                  @hasrole('city-manager')
                <select class="form-control" name="gym_id">
                  @foreach($gyms as $gym)
                      <option value="{{$gym->id}}" >{{$gym->name}}</option>
                  @endforeach
                      <select class="form-control" name="gym_id">
                  @endrole
                  @hasrole('gym-manager')
                <select class="form-control" name="gym_id"  readonly>
                  <option value="{{$gyms->id}}" >{{$gyms->name}}</option>
                </select>
                  @endrole
            </div>
        </div>

      <!-- select -->
      <div class="box-body">
        <div class="form-group">
            <label class='control-label'>Card Number</label>
            <input autocomplete='off' class='form-control card-number' size='20' type='text' name="card_no">
        </div>
      </div>
      @if ($errors->has('card_no'))
    <div class="alert alert-danger" style="margin: 4px;">
        <ul style="list-style: none;">
                <li>{{ $errors->first('card_no')}}</li>
        </ul>
    </div>
    <br>
    @endif

      <div class="box-body">
        <div class="form-group">
                <div class='col-xs-4 form-group cvc required'>

                        <label class='control-label'>CVV</label>
                            <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text' name="cvv">
                        </div>

                        <div class='col-xs-4 form-group expiration'>
                            <label class='control-label'>Expiration</label>
                            <input class='form-control card-expiry-month' placeholder='MM' size='4' type='text' name="expiry_month">
                        </div>

                        <div class='col-xs-4 form-group expiration'>

                        <label class='control-label'> </label>

                        <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text' name="expiry_year">
                        </div>
                        </div>
                        </div>
                        @if ($errors->has('cvv'))
    <div class="alert alert-danger" style="margin: 4px;">
        <ul style="list-style: none;">
                <li>{{ $errors->first('cvv')}}</li>
        </ul>
    </div>
    <br>
    @endif

    @if ($errors->has('expiry_month'))
    <div class="alert alert-danger" style="margin: 4px;">
        <ul style="list-style: none;">
                <li>{{ $errors->first('expiry_month')}}</li>
        </ul>
    </div>
    <br>
    @endif

    @if ($errors->has('expiry_year'))
    <div class="alert alert-danger" style="margin: 4px;">
        <ul style="list-style: none;">
                <li>{{ $errors->first('expiry_year')}}</li>
        </ul>
    </div>
    <br>
    @endif


    <div class="box-footer">
                <button type="submit" class="btn btn-primary">Buy</button>
            </div>
    </form>
  </div>
@endsection

@section('scripts')

@endsection
