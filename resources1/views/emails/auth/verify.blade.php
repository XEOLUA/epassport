@component('mail::message')
# Наші вітання!

Натисніть "Активувати обіковий запис", щоб здійснити вхід на сайті E-pass. (одноразово)

@component('mail::button', ['url' => route('register.verify', ['token' => $user->verify_token])])
    Активувати обіковий запис
@endcomponent

Дякуємо,<br>
{{ config('app.name') }}
@endcomponent
