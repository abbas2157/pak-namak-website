<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $fillable = ['name', 'phone', 'product', 'message', 'is_read'];

    protected $casts = ['is_read' => 'boolean'];
}
