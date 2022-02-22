@component('mail::message')
# Greetings, 
Name: {{$details['Name']}}
<p><strong>{{$details['m_subject']}}</strong></p>

<p>{{$details['m_message']}}</p>

Thanks,<br>

{{ config('app.name') }}
@endcomponent
