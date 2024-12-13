<?php

return [


'middleware' => [
    'role' => Spatie\Permission\Middlewares\RoleMiddleware::class,
    'role_or_permission' => Spatie\Permission\Middlewares\RoleOrPermissionMiddleware::class,
],

    'models' => [

        'permission' => Spatie\Permission\Models\Permission::class,
        'role' => Spatie\Permission\Models\Role::class,

    ],
        'table_names' => [
            'permissions' => 'permissions',
            'roles' => 'roles',
            'model_has_permissions' => 'model_has_permissions',
            'model_has_roles' => 'model_has_roles',
            'role_has_permissions' => 'role_has_permissions',
        ],
        'column_names' => [
            'role_pivot_key' => 'role_id',
            'permission_pivot_key' => 'permission_id',
            'model_morph_key' => 'model_id',
            'team_foreign_key' => 'team_id',
        ],
    

    'register_permission_check_method' => true,
    'register_octane_reset_listener' => false,

    'teams' => false, // Set to true if you are using teams in your app

    'use_passport_client_credentials' => false,

    'display_permission_in_exception' => false,
    'display_role_in_exception' => false,
    'enable_wildcard_permission' => false,

    'cache' => [
        'expiration_time' => \DateInterval::createFromDateString('24 hours'),
        'key' => 'spatie.permission.cache',
        'store' => 'file', // Specify the cache driver
    ],

];
