<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property string name
 * @property int owner_id
 * @property int number_of_users
 */
class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'owner_id',
        'number_of_users',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
