<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pages extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function adSpaces()
    {
        return $this->hasMany(AdSpace::class,'page_id','id');
    }

}
