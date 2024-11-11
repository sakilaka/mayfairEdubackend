<h1>To Reset your password go to this link, Thank you.</h1>

@php
     $user = \App\Models\User::find($value['id']);
@endphp
@if ($user->type==0)
<a href="{{ url('admin-forgot-password/'.$value['id']) }}?token={{ $value['token'] }}">Click Here To Reset Admin Password</a>
@else
<a href="{{ url('forgot-password/'.$value['id']) }}?token={{ $value['token'] }}">Click Here To Reset Password</a>
@endif

