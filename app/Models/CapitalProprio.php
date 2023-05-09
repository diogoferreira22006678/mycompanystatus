<?php

namespace App\Models;

use App\Models\Balance;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapitalProprio extends Model
{
    use HasFactory;

    protected $table = 'capitaisproprios';
    protected $primaryKey = 'capitaisproprios_id';
    protected $fillable = ['balanco_id'];

    // Each capital proprio belongs to a balance
    public function balance()
    {
        return $this->belongsTo(Balance::class, 'balanco_id', 'balanco_id');
    }
    
}
