<x-mail::message>
# Account Declined

Dear {{ $user->name }},

Your account verification has been declined this because your datd not valid.

Please update your profiles and account will verified maximum 24 hours

<x-mail::button :url="$actionUrl">
Review Account
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
