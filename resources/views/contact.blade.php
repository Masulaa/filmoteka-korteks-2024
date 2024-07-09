@component('mail::message')
# Contact from {{ $name }}

{{ $content }}


Thanks,<br>
{{ config('app.name') }}
@endcomponent