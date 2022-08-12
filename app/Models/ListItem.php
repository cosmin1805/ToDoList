<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListItem extends Model
{
    protected $fillable = [
        'name',
        'username',
        'is_complete',
    ];
    
    use HasFactory;
}
