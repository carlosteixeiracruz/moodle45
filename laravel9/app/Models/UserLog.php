<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    use HasFactory;

    // Definir o nome da tabela
    protected $table = 'user_log'; // Nome da tabela no banco de dados

    // Definir as colunas que podem ser preenchidas (mass assignable)
    protected $fillable = [
        'user_id',
        'device_type',
        'user_log',
        'ip',
        'remember_token',
    ];

    // Caso você não queira que o Eloquent gerencie as colunas 'created_at' e 'updated_at'
    // você pode desabilitar o gerenciamento automático delas:
    public $timestamps = true; // Ou false, se não usar os campos created_at/updated_at.
}
