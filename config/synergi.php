<?php

declare(strict_types=1);

return [
    "users" => [
        "countCacheTtl"     => env("SYNERGI_USERS_COUNT_CACHE_TTL", 21600), // default is 6 hours
        "paginationSize"    => env("SYNERGI_PAGINATION_SIZE", 50),
    ]
];