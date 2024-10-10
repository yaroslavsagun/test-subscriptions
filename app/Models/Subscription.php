<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string name
 * @property int month_price
 * @property int year_price
 */
class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'month_price',
        'year_price',
    ];
}
