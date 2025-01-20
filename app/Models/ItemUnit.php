<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemUnit extends Model
{
    use HasFactory;
    protected $table = 'item_unit';
    protected $fillable = [
        'Unit_Code',
        'Unit_Name',
        'Unit_Status',
        'MainUnit_Code',
        'IsMainUnit',
        'MultiplierValue',
        'Unit_IsCancel',
    ];
}
