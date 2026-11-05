<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    /**
     * Offer statuses
     */
    public const STATUSES = [
        'pending' => 'Чакащо',
        'processing' => 'В обработка',
        'completed' => 'Завършено',
        'cancelled' => 'Отказано',
    ];

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'name',
        'phone',
        'length',
        'width',
        'height',
        'status',
    ];

    /**
     * Attribute casts
     */
    protected $casts = [
        'length' => 'integer',
        'width' => 'integer',
        'height' => 'integer',
    ];

  
}
