<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    protected $fillable = ['image'];

    public $incrementing = true;
    protected $primaryKey = 'id';
}
