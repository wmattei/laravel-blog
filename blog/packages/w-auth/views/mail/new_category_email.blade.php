@component('mail::message')
    # Nova categoria

    Foi cadastrada uma nova categoria

    # {{$category['name']}}

    Thanks
    {{ config('app.name') }}
@endcomponent
