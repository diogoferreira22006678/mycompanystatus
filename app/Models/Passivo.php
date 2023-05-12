<?php

namespace App\Models;

use App\Models\Balance;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passivo extends Model
{
    use HasFactory;

    protected $table = 'passivos';
    protected $primaryKey = 'passivo_id';
    protected $fillable = ['balanco_id'];

    // Each ativo corrente belongs to a balancea
    public function balance()
    {
        return $this->belongsTo(Balance::class, 'balanco_id', 'balanco_id');
    }
}
