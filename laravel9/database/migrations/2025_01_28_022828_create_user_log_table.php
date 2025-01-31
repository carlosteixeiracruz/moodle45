<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_log', function (Blueprint $table) {
            $table->id()->comment('ID do log, auto-increment');  // Campo id auto-increment
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->comment('ID do usuário que gerou o log');  // Relacionamento com a tabela 'users'
            $table->string('ip')->comment('IP do usuário (pode ser de desktop ou mobile)');  // Campo para guardar o IP
            $table->string('device_type')->nullable()->comment('Tipo de dispositivo (desktop, mobile, etc)');  // Campo para tipo de dispositivo (desktop, mobile, etc)
            $table->rememberToken()->comment('Token de autenticação para o usuário');  // Campo para armazenar o remember_token
            $table->timestamp('created_at')->nullable()->comment('Data e hora de criação');
            $table->timestamp('updated_at')->nullable()->comment('Data e hora de última atualização');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_log');
    }
};


