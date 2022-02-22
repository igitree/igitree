@component('mail::message')
# Greetings, 
{{$details['title']}}<br>

{{$details['body']}}

@component('mail::button', ['url' => 'http://127.0.0.1:8000/tree/view'])
view more
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
