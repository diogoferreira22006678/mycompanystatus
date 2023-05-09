<?php

namespace App\Models;

use App\Models\Ativo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtivoNaoCorrente extends Model
{
    use HasFactory;

    protected $table = 'ativosnaocorrentes';
    protected $primaryKey = 'ativosnaocorrente_id';
    protected $fillable = ['ativo_id'];

    // Each ativo corrente belongs to a ativo
    public function ativo()
    {
        return $this->belongsTo(Ativo::class, 'ativo_id', 'ativo_id');
    }
}
