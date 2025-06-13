<?php

return [
    'groups' => [
        'feed' => [
            \App\Filters\LimitFilter::class,
            \App\Filters\PaginateFilter::class,
            \App\Filters\OrderFilter::class,
        ],
        'jobs' => [
            \App\Filters\LimitFilter::class,
            \App\Filters\PaginateFilter::class,
            \App\Filters\OrderFilter::class,
        ],
        'articles' => [
            \App\Filters\LimitFilter::class,
            \App\Filters\PaginateFilter::class,
            \App\Filters\OrderFilter::class,
            \App\Filters\ArticleCategoryFilter::class,

        ],
    ]
];
