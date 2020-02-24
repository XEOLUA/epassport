@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => route('register.verify', ['token' => $user->verify_token])])
    Verify Email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
