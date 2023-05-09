<?php

namespace App\Models;

use App\Models\Passivo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassivoCorrente extends Model
{
    use HasFactory;

    protected $table = 'passivoscorrentes';
    protected $primaryKey = 'passivoscorrente_id';
    protected $fillable = ['passivo_id'];

    // Each ativo corrente belongs to a ativo
    public function passivo()
    {
        return $this->belongsTo(Passivo::class, 'passivo_id', 'passivo_id');
    }
}
