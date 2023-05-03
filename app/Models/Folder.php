<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'company';
    protected $primaryKey = 'company_id';
    protected $fillable = ['company_name', 'company_address', 'company_email', 'company_phone', 'company_nif',
                           'company_sector', 'company_website','user_id'];

    public function reports()
    {
        return $this->hasMany(Report::class, 'company_id', 'company_id');
    }

    
}
