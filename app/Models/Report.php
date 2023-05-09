<?php

namespace App\Models;

use App\Models\Resultado;
use App\Models\Balance;
use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports';
    protected $primaryKey = 'report_id';
    protected $fillable = ['report_year, report_status, company_id'];

    // Each report belongs to a company 
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'company_id');
    }

    // Each report has a resultado
    public function resultado()
    {
        return $this->hasOne(Resultado::class, 'report_id', 'report_id');
    }

    // Each report has a balance
    public function balance()
    {
        return $this->hasOne(Balance::class, 'report_id', 'report_id');
    }

}
