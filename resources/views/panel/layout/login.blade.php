@extends('panel.public.master')
@section('content')
<div class="row">
    <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2" style="margin-top: 110px;margin-bottom: 119px;">
            <div class="sign-inner" ng-form="loginForm">
                <div>
                    <h3 class="first-child text-center" style="font-size:27px;color:#9d2118;margin-bottom: 0px;font-weight:bold">প্রবেশ করুন</h3>
                </div>
                <div class="error">
                    @include('panel.layout.messages')
                </div>
                    <form action="{{route('attempt_login')}}" class="form-horizontal" method="post" autocomplete="off">
                        @method('POST')
                        @csrf
                        <label class="sr-only">Enter Mobile No</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" name="username" class="form-control" placeholder="Enter your phone"/>
                    </div>
                    <br>
                    <label class="sr-only">Enter password</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="Password"/>
                    </div>
  
                    <button type="submit" class="ha-btn-small">প্রবেশ</button>
                    </form>
            </div>
    </div>
</div>
@endsection