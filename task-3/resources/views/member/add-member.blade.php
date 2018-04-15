@extends('layout.default')
@section('title', 'Add New Member')
@section('content')
<div class="container text-center">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Add New Member</h3>
                </div>
                <div class="panel-body">
                    @if (\Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ \Session::get('success') }}</p>
                        </div>
                    @endif
                    <form id="memberadd" class="form" method="post" action="{{url('member/save-member')}}">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-6 text-left">
                                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                    <label>First Name <span class="text-danger">*</span></label>
                                    <input type="text" name="first_name" placeholder="First Name" value="{{ old('first_name') }}" class="form-control" required />
                                    @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                    <label>Last Name <span class="text-danger">*</span></label>
                                    <input type="text" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}" class="form-control" required />
                                    @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" placeholder="Email ID" value="{{ old('email') }}" class="form-control" required />
                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                    <label>Mobile Number</label>
                                    <input type="text" name="phone" placeholder="Mobile Number" value="{{ old('phone') }}" class="form-control" />
                                    @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                                    <label>Country <span class="text-danger">*</span></label>
                                    <select name="country" class="form-control" required>
                                        <option value="">Select Country</option>
                                        @foreach($countries AS $country)
                                        <option value="{{$country->code}}">{{$country->name}}</option> 
                                        @endforeach
                                    </select>
                                    @if ($errors->has('country'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 text-left">
                                <div class="form-group{{ $errors->has('dateofbirth') ? ' has-error' : '' }}">
                                    <label>Birth Date <span class="text-danger">*</span></label>
                                    <input type="date" name="dateofbirth" placeholder="Date of Birth" value="{{ old('dateofbirth') }}" class="form-control" max="<?php echo date("Y-m-d", strtotime(date("Y-m-d", strtotime(date("Y-m-d", time()))) . " - 13 years")); ?>" required />
                                    @if ($errors->has('dateofbirth'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dateofbirth') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('aboutyou') ? ' has-error' : '' }}">
                                    <label>About Member <span class="text-danger">*</span></label>
                                    <textarea name="aboutyou" class="form-control" rows="12" placeholder="About Member" required>{{old('aboutyou')}}</textarea>
                                    @if ($errors->has('aboutyou'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('aboutyou') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-lg btn-success">Add Member Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('pageScript')
<script src="{{asset('jquery_validate/jquery.validate.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/member_add_form.min.js')}}" type="text/javascript"></script>
@endsection