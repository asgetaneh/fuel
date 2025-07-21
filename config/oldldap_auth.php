<?php

return [

    'provider' => LdapRecord\Laravel\Auth\DatabaseUserProvider::class,

    'model' => App\Models\User::class,

    'rules' => [
        LdapRecord\Laravel\Auth\Rules\DenyTrashed::class,
    ],

    'scopes' => [
        // e.g., LdapRecord\Laravel\Scopes\UpnScope::class,
    ],

    'database' => [
        'model' => App\Models\User::class,

        'sync_passwords' => false,

        'sync_attributes' => [
            'name' => 'cn',
            'email' => 'mail',
        ],

        'username_column' => 'email',
        'ldap_column' => 'mail',

        'locate_users_by' => 'mail',
        'bind_users_by' => 'distinguishedname',
    ],

];
