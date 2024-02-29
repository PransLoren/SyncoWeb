@component('mail::message')
Hello {{$user->name}},

<p>Kalimutan mo nalang siya, wag lang yung password mo ./.</p>

@component('mail::button',['url' => url('reset/'.$user->remember_token)])
Reset Your Password
@endcomponent

<p>Alalahanin mo na, wag mo na kami abalahin.</p>

Thanks,<br>
{{config('app.name')}}
@endcomponent