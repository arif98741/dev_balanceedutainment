<?php

return [

    /*
      |--------------------------------------------------------------------------
      | oAuth Config
      |--------------------------------------------------------------------------
     */

    /**
     * Storage
     */
    'storage' => '\\OAuth\\Common\\Storage\\Session',
    /**
     * Consumers
	 ,'gmail_compose'
     */
    'consumers' => [

        'Google' => [
            'client_id' => '278937411437-8juksrhhrcd5apav8f98dchg4gh7i49b.apps.googleusercontent.com',
            'client_secret' => 'l3yHj1_5Tw2_Qc0-tBTp1WOq',
            'scope' => ['userinfo_email', 'userinfo_profile', 'https://www.google.com/m8/feeds/'],
        ],
        'Yahoo' => [
            'client_id' => 'dj0yJmk9VFlWUWVJYU9QQTQ5JmQ9WVdrOVJ6TlFZMkZNTjJjbWNHbzlNQS0tJnM9Y29uc3VtZXJzZWNyZXQmeD01ZQ--',
            'client_secret' => '74e8cef1c43c2f41ae5bef41048f81b3fc9519bc',
        ],
        'Facebook' => [
            'client_id' => '345907455844068',
            'client_secret' => '2af527310c31f7a83690671f2f19a49a',
            'scope' => ['email', 'user_friends'],
        ],
        'Linkedin' => [
            'client_id' => 'Your Linkedin API ID',
            'client_secret' => 'Your Linkedin API Secret',
        ]
    ]
];