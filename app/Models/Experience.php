<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    //
    protected $table = "experiences";
    protected $fillable = [
        'user_id',
        'company',
        'position',
        'started_at',
        'resign_at',
    ];

    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }
}
