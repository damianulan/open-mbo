<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Font Options
    |--------------------------------------------------------------------------
    |
    | Here you may specify font family and font color.
    |
    */

    'options' => [
        'chart' => [
            'type' => 'line',
            'height' => 300,
            'width' => '100%',
            'toolbar' => [
                'show' => false,
            ],
            'stacked' => false,
            'zoom' => [
                'enabled' => true,
            ],
            'fontFamily' => 'inherit',
            'foreColor' => 'var(--bs-primary)',
        ],

        'plotOptions' => [
            'bar' => [
                'horizontal' => false,
            ],
        ],

        'colors' => [
            '#008FFB',
            '#00E396',
            '#feb019',
            '#ff455f',
            '#775dd0',
            '#80effe',
            '#0077B5',
            '#ff6384',
            '#c9cbcf',
            '#0057ff',
            '#00a9f4',
            '#2ccdc9',
            '#5e72e4',
        ],

        'series' => [],

        'dataLabels' => [
            'enabled' => false,
        ],

        'labels' => [],

        'legend' => [
            'fontFamily' => 'inherit',
        ],

        'title' => [
            'text' => [],
        ],

        'subtitle' => [
            'show' => false,
            'text' => '',
            'align' => 'left',
        ],

        'xaxis' => [
            'categories' => [],
        ],

        'grid' => [
            'show' => true,
        ],

        'markers' => [
            'size' => 4,
            'colors' => [
                '#008FFB',
                '#00E396',
                '#feb019',
                '#ff455f',
                '#775dd0',
                '#80effe',
                '#0077B5',
                '#ff6384',
                '#c9cbcf',
                '#0057ff',
                '#00a9f4',
                '#2ccdc9',
                '#5e72e4',
            ],
            'strokeColors' => '#fff',
            'strokeWidth' => 2,
            'hover' => [
                'size' => 7,
            ],
        ],

        'stroke' => [
            'show' => false,
            'width' => 4,
            'colors' => [
                '#008FFB',
                '#00E396',
                '#feb019',
                '#ff455f',
                '#775dd0',
                '#80effe',
                '#0077B5',
                '#ff6384',
                '#c9cbcf',
                '#0057ff',
                '#00a9f4',
                '#2ccdc9',
                '#5e72e4',
            ],
        ],
    ],

];
