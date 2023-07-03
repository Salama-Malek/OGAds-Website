<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['url'];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
