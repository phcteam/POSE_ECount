<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $table = 'area';
    protected $fillable = [
        'Code',
        'Name',
        'Pv_Code',
        'Employee_Code',
        'Hotpital_Count',
        'isPresent',
        'Is_Cloning',
        'Tax_percent',
        'Tax_reward',
        'IsStatusArea',
        'Tax_percent_report',
        'IsCms',
        'IsStatus',
        'IsGuarantee',
        'IsBooth',
        'IsBkk',
        'IsDealer',
        'IsCustomItem',
    ];

    // public function Area()
    // {
    //     return $this->hasOne(Area::class, 'Code', 'AreaCode');
    // }
}
