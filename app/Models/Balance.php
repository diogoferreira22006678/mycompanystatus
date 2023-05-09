<?php

namespace App\Models;

use App\Models\Ativo;
use App\Models\Passivo;
use App\Models\CapitalProprio;
use App\Models\Report;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;

    protected $table = 'balancos';
    protected $primaryKey = 'balanco_id';
    protected $fillable = ['report_id'];

    // Each balance belongs to a report
    public function report()
    {
        return $this->belongsTo(Report::class, 'report_id', 'report_id');
    }

    // Each balance has a ativo
    public function ativo()
    {
        return $this->hasOne(Ativo::class, 'balanco_id', 'balanco_id');
    }

    // Each balance has a passivo
    public function passivo()
    {
        return $this->hasOne(Passivo::class, 'balanco_id', 'balanco_id');
    }

    // Each balance has a capital proprio
    public function capitalProprio()
    {
        return $this->hasOne(CapitalProprio::class, 'balanco_id', 'balanco_id');
    }
}
