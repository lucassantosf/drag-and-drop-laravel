<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $table = 'files';

    /* Array de campos protegidos a serem gravados no banco */
    protected $fillable = ['file', 'user_id'];

    /* Array de campos para auxiliar na exibição da url da imagem na view */
    protected $appends = ['file_url'];

    /* Função para adicionar a URL do site automaticamente na imagem após puxar do banco URL determinada no .env */
    public function getFileUrlAttribute($value) {
        return config('app.url').'uploads/'.$this->file;
    } 
}
