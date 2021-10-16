@component('mail::message')
# Welcome to imageBlog

You have registered to an image blogging app built with laravel.

{{--@component('mail::button', ['url' => ''])--}}
{{--Button Text--}}
{{--@endcomponent--}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
