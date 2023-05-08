<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;

    protected $table = 'sectors';
    protected $primaryKey = 'sector_id';
    protected $fillable = ['sector_name'];

    // Each sector has many companies
    public function companies()
    {
        return $this->hasMany(Company::class, 'sector_id', 'sector_id');
    }
}
