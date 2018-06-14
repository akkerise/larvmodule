@if ($isLogged)
<a href="{{ url('logout/' . $cookie['access_token'])}}" title="Sign in" class="signInLink" style="display:block;text-align: right;">{{$cookie['fullname']}} | Logout</a>
@else
<a href="{{$endPoint}}" title="Sign in" class="signInLink" style="display:block;text-align: right;">Sign in</a>
@endif