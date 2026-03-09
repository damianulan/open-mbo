<?php

return [
    /*
     * DataTables JavaScript global namespace.
     */

    'namespace' => 'LaravelDataTables',

    /*
     * Default table attributes when generating the table.
     */
    'table' => [
        'class' => 'table ombo-table',
        'id' => 'dataTableBuilder',
    ],

    /*
     * Html builder script template.
     */
    'script' => 'vendor.datatables.script',

    /*
     * Html builder script template for DataTables Editor integration.
     */
    'editor' => 'vendor.datatables.editor',
];
