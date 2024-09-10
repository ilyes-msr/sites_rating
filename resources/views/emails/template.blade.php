<x-mail::message>
<h2>مرحبا</h2>

المستخدم: {{$data['name']}}
<br>
أبلغ عن الرابط: {{$data['place_url']}}
<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
