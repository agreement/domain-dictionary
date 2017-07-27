<?php

return [
    "api_url"     => 'https://domainr.p.mashape.com',

    "mashape_key" => env('DOMAINR_MASHAPE_KEY'),

    'statuses'   => [
        'unknown'   => [
            'available'     => false,
            'description'   => 'Unknown status, usually resulting from an error or misconfiguration.'
        ],
        'undelegated'   => [
            'available'     => false,
            'description'   => 'The domain is not present in DNS.'
        ],
        'inactive'   => [
            'available'     => true,
            'description'   => 'Available for new registration.'
        ],
        'pending'   => [
            'available'     => false,
            'description'   => 'TLD not yet in the root zone file.'
        ],
        'unregistrable'   => [
            'available'     => false,
            'description'   => 'No registrars offer this domain for sale.'
        ],
        'disallowed'   => [
            'available'     => false,
            'description'   => 'Disallowed by the registry, ICANN, or other (wrong script, etc.).'
        ],
        'claimed'   => [
            'available'     => false,
            'description'   => 'Claimed or reserved by some party (not available for new registration).'
        ],
        'reserved'   => [
            'available'     => false,
            'description'   => 'Explicitly reserved by ICANN, the registry, or another party.'
        ],
        'dpml'   => [
            'available'     => false,
            'description'   => 'Domains Protected Marks List, reserved for trademark holders.'
        ],
        'invalid'   => [
            'available'     => false,
            'description'   => 'Technically invalid, e.g. too long or too short.'
        ],
        'active'   => [
            'available'     => false,
            'description'   => 'Registered, but possibly available via the aftermarket.'
        ],
        'parked'   => [
            'available'     => false,
            'description'   => 'Active and parked.'
        ],
        'marketed'   => [
            'available'     => true,
            'description'   => 'Explicitly marketed as for sale.'
        ],
        'expiring'   => [
            'available'     => false,
            'description'   => 'An expiring domain e.g. from the SnapNames inventory.'
        ],
        'deleting'   => [
            'available'     => false,
            'description'   => 'A deleting domain e.g. from the SnapNames inventory.'
        ],
        'priced'   => [
            'available'     => true,
            'description'   => 'An aftermarket domain with an explicit price e.g. from the BuyDomains inventory.'
        ],
        'transferable'   => [
            'available'     => true,
            'description'   => 'An aftermarket domain available for fast-transfer e.g. from the Afternic inventory.'
        ],
        'premium'   => [
            'available'     => true,
            'description'   => 'Premium domain name for sale by the registry.'
        ],
        'suffix'   => [
            'available'     => false,
            'description'   => 'A public suffix according to publicsuffix.org.'
        ],
        'registrar'   => [
            'available'     => false,
            'description'   => 'A domain controlled by a registrar.'
        ],
        'zone'   => [
            'available'     => false,
            'description'   => 'A zone (domain extension) in the Domainr database.'
        ],
        'tld'   => [
            'available'     => false,
            'description'   => 'Top-level domain.'
        ],
    ]
];