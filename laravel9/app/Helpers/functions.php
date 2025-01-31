<?php

use App\Models\UserLog;
use App\Models\User;

if (!function_exists('insertLog'))  {
    function insertLog($user, $deviceType, $ip)
    {

        // Inserir o novo registro na tabela `user_log`
        return UserLog::create([
            'user_id'       => $user->id, // ID do usuário, vindo do objeto $user
            'device_type'   => $deviceType, // Tipo do dispositivo
            'ip'            => $ip, // IP do usuário
            'remember_token'=> $user->remember_token, // Token gerado
        ]);
    }
}

if (!function_exists('selectUser')) {
    function selectUser($campo, $dado)
    {
        $tblPrefix = env('MOODLE_TBL_PREFIX');

        // Buscar o usuário no banco de dados Moodle
        return DB::connection('moodle')->table($tblPrefix.'user')
        ->where($campo, $dado)
        ->first();
    }
}

