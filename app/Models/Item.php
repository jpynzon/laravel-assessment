<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';
    protected $fillable = ['name', 'description'];

    // You can also specify the table if it does not follow Laravel's naming convention
    // protected $table = 'items';
}
