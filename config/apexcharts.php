<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Font Options
    |--------------------------------------------------------------------------
    |
    | Here you may specify font family and font color.
    |
    */

    'options' => array(
        'chart' => array(
            'type' => 'line',
            'height' => 500,
            'width' => null,
            'toolbar' => array(
                'show' => false,
            ),
            'stacked' => false,
            'zoom' => array(
                'enabled' => true,
            ),
            'fontFamily' => 'Inter',
            'foreColor' => '#373d3f',
        ),

        'plotOptions' => array(
            'bar' => array(
                'horizontal' => false,
            ),
        ),

        'colors' => array(
            '#008FFB', '#00E396', '#feb019', '#ff455f', '#775dd0', '#80effe',
            '#0077B5', '#ff6384', '#c9cbcf', '#0057ff', '#00a9f4', '#2ccdc9', '#5e72e4',
        ),

        'series' => array(),

        'dataLabels' => array(
            'enabled' => false,
        ),

        'labels' => array(),

        'title' => array(
            'text' => array(),
        ),

        'subtitle' => array(
            'text' => 'undefined',
            'align' => 'left',
        ),

        'xaxis' => array(
            'categories' => array(),
        ),

        'grid' => array(
            'show' => true,
        ),

        'markers' => array(
            'size' => 4,
            'colors' => array(
                '#008FFB', '#00E396', '#feb019', '#ff455f', '#775dd0', '#80effe',
                '#0077B5', '#ff6384', '#c9cbcf', '#0057ff', '#00a9f4', '#2ccdc9', '#5e72e4',
            ),
            'strokeColors' => '#fff',
            'strokeWidth' => 2,
            'hover' => array(
                'size' => 7,
            ),
        ),

        'stroke' => array(
            'show' => true,
            'width' => 4,
            'colors' => array(
                '#008FFB', '#00E396', '#feb019', '#ff455f', '#775dd0', '#80effe',
                '#0077B5', '#ff6384', '#c9cbcf', '#0057ff', '#00a9f4', '#2ccdc9', '#5e72e4',
            ),
        ),
    ),

);
