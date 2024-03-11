<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdSpace extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function page()
    {
        return $this->belongsTo(Pages::class,'page_id','id');
    }

}
