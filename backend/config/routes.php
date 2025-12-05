<?php
/**
 * Optional Route Mapping
 * Tidak digunakan sebagai router otomatis,
 * hanya dokumentasi internal agar struktur API jelas.
 */

return [
    'login'            => 'AuthController@login',
    'logout'           => 'AuthController@logout',
    'profile.update'   => 'UserController@updateProfile',
    'settings.get'     => 'SettingController@get',
    'settings.update'  => 'SettingController@update',
    'orders.list'      => 'OrderController@list',
    'orders.detail'    => 'OrderController@detail',
    'orders.retry'     => 'OrderController@retry',
    'dashboard.stats'  => 'OrderController@dashboardStats',
    'callback.digi'    => 'CallbackController@handle',
];
