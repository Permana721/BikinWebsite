protected $listen = [
    \SocialiteProviders\Manager\SocialiteWasCalled::class => [
        \SocialiteProviders\Instagram\InstagramExtendSocialite::class.'@handle',
    ],
];