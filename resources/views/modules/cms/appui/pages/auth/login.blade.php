@extends('cms::appui.layouts.notauth')

@section('content')
    <!-- Login Container -->
    <div id="login-container">
        <!-- Login Header -->
        <h1 class="h2 text-light text-center push-top-bottom animation-slideDown">
            <i class="fa fa-cube"></i> <strong>Welcome to <br> h5 Game CMS</strong>
        </h1>
        <!-- END Login Header -->

        <!-- Login Block -->
        <div class="block animation-fadeInQuickInv">
            <!-- Login Title -->
            <div class="block-title">
                <div class="block-options pull-right">
                    {{-- <a href="page_ready_reminder.html" class="btn btn-effect-ripple btn-primary" data-toggle="tooltip" data-placement="left" title="Forgot your password?"><i class="fa fa-exclamation-circle"></i></a> --}}
                    {{-- <a href="javascript:void(0)" class="btn btn-effect-ripple btn-primary" data-toggle="tooltip" data-placement="left" title="Create new account"><i class="fa fa-plus"></i></a> --}}
                </div>
                <h2>Please Login</h2>
            </div>
            <!-- END Login Title -->

            <!-- Login Form -->
            <form id="form-login" action="{{ url('cms/login') }}" method="post" class="form-horizontal">
                {{ csrf_field() }}
                <div class="form-group">
                    <div class="col-xs-12">
                        <input type="email" id="login-email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Your email..">
                        @if($errors->has('email'))
                            <div class="error-text text-danger">
                                {{$errors->first('email')}}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input type="password" id="login-password" name="password" value="{{ old('password') }}" class="form-control" placeholder="Your password..">
                        @if($errors->has('password'))
                            <div class="error-text text-danger">
                                {{$errors->first('password')}}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group form-actions">
                    <div class="col-xs-8">
                        <label class="csscheckbox csscheckbox-primary">
                            <input type="checkbox" id="login-remember-me" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span></span>
                        </label>
                        Remember Me?
                    </div>
                    <div class="col-xs-4 text-right">
                        <button type="submit" class="btn btn-effect-ripple btn-sm btn-primary"><i class="fa fa-check"></i> Let's Go</button>
                    </div>
                </div>
            </form>
            <!-- END Login Form -->

        </div>
        <!-- END Login Block -->

        <!-- Footer -->
        <footer class="text-muted text-center animation-pullUp">
            <small><span id="year-copy"></span> &copy; <a href="http://goo.gl/RcsdAh" target="_blank">AppUI 2.7</a>
            </small>
        </footer>
        <!-- END Footer -->
    </div>
    <!-- END Login Container -->
@endsection
