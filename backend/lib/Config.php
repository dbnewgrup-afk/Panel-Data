<?php
require_once __DIR__.'/../models/SettingModel.php';

class Config
{
    public static function load($db)
    {
        $setting = new SettingModel($db);
        return [
            'digiflazz_key'    => $setting->get('digiflazz_key'),
            'digiflazz_secret' => $setting->get('digiflazz_secret'),
            'tokoku_client_id' => $setting->get('tokoku_client_id'),
            'tokoku_secret'    => $setting->get('tokoku_secret'),
            'webhook_url'      => $setting->get('webhook_url'),
        ];
    }
}
