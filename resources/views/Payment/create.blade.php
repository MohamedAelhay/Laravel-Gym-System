@extends('admin')
@section('content')
 <!-- general form elements -->
 <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Buy a package for one of our members</h3>
    </div>
    <!-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif -->
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

        <div class="box-body">
            <div class="form-group">
              <label>Choose a Gym to buy package from</label>
              <select class="form-control" name="gym_id">
                    @foreach ($gyms as $gym)
                    <option value="{{$gym->id}}">{{$gym->name}}</option>
                    @endforeach
              </select>
            </div>
        </div>

      <!-- select -->
      <div class="box-body">
        <div class="form-group">
            <label class='control-label'>Card Number</label>
            <input autocomplete='off' class='form-control card-number' size='20' type='text' name="card_no">
        </div>
      </div>

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


        <button type="submit" class="btn btn-block btn-primary btn-lg">Buy Package</button>
    </form>
  </div>
@endsection

@section('scripts')

@endsection
