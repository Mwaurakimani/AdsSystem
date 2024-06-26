<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function stats(){
        return $this->hasMany(CampaignsPages::class);
    }

    public function owner(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
