<?php

return [
    /*
     * Encoding used when converting strings to uppercase. If null, the
     * current internal encoding configured in PHP will be used.
     */
    'encoding' => 'UTF-8',

    /*
     * Whether the value should be trimmed after applying the upper conversion.
     */
    'trim' => true,

    /*
     * Attributes that should always be converted to uppercase. When this list
     * is not empty, only the attributes listed here will be normalized.
     */
    'only_upper' => [],

    /*
     * Attributes that should never be converted to uppercase.
     */
    'no_upper' => [],

    /*
     * Attributes that should be ignored by default. These values can still be
     * overridden on a per-model basis using the `$only_upper` or `$no_upper`
     * properties.
     */
    'ignore_attributes' => [
        'id',
        'password',
        'password_confirm',
        'remember_token',
        'slug',
        'language',
        'tenant',
        'tenant_branch',
        'model_auth',
        'model',
    ],

    /*
     * Attribute suffixes that identify morph relationship columns. Any
     * attribute containing the suffix will be ignored.
     */
    'morph_suffixes' => ['_type', '_id'],
];
