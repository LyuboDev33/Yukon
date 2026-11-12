<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class PigeonExpressOffice extends Model
{
    protected $table = 'pigeon_express_offices';

    protected $fillable = [
        'code',
        'address',
    ];
}
