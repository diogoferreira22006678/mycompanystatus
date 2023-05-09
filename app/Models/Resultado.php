<?php

namespace App\Models;

use App\Models\Report;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resultado extends Model
{
    use HasFactory;

    protected $table = 'resultados';
    protected $primaryKey = 'resultado_id';
    protected $fillable = ['report_id'];

    // Each resultado belongs to a report
    public function report()
    {
        return $this->belongsTo(Report::class, 'report_id', 'report_id');
    }
    
}
