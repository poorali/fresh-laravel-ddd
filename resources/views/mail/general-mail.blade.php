<x-mail::message>
# {{$title}}
## {{$subtitle ?? ''}}

{!! $body !!}

@if(!empty($cta) && !empty($cta['title']) && !empty($cta['link']))
<x-mail::button url="{{$cta['link']}}">
{{$cta['title']}}
</x-mail::button>
@endif

{{--Thanks,<br>--}}
{{--{{ config('app.name') }}--}}
</x-mail::message>
