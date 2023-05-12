<?php

namespace App\Models;

use App\Models\Balance;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ativo extends Model
{
    use HasFactory;

    protected $table = 'ativos';
    protected $primaryKey = 'ativo_id';
    protected $fillable = ['balanco_id'];

    // Each ativo corrente belongs to a balancea
    public function balance()
    {
        return $this->belongsTo(Balance::class, 'balanco_id', 'balanco_id');
    }
}
