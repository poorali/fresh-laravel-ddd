<x-mail::layout>
{{-- Header --}}
<x-slot:header>
<x-mail::header :url="config('app.url')">
{{ config('app.name') }}
</x-mail::header>
</x-slot:header>

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
<x-slot:subcopy>
<x-mail::subcopy>
{{ $subcopy }}
</x-mail::subcopy>
</x-slot:subcopy>
@endisset

{{-- Footer --}}
<x-slot:footer>
<x-mail::footer>
© {{ date('Y') }} <a href="{{app('configs')['SiteURL']}}">{{app('configs')['SiteTitle']}}</a>. {{ __('All rights reserved.') }}
    <br>
    {{__('messages.MailMemberShipTip')}} <a href="{{app('configs')['SiteURL']}}">{{app('configs')['SiteTitle']}}</a>
</x-mail::footer>
</x-slot:footer>
</x-mail::layout>
