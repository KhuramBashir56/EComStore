<x-ui.mail.body>
    <x-ui.mail.greeting :content="__('Hi! ')" />
    <x-ui.mail.message :content="__('You have requested to subscribed to ' . config('app.name') . ' newsletter. We will keep you updated using this email on the new products, offers, latest news and promotions.')" />
    <x-ui.mail.action :content="__('Please confirm your email click on the button below')">
        <x-ui.mail.button :title="__('Confirm Subscription')" href="{{ route('newsletter_subscription_confirmation', ['ref_id' => $ref_id]) }}" />
    </x-ui.mail.action>
    <x-ui.mail.message :content="__('If you did not request for our email subscription do not share this email with anyone, please ignore this email and no further action will be taken.')" />
    <x-ui.mail.message :content="__('If you have any questions, please contact our support team.')" />
</x-ui.mail.body>
