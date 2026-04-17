<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendingMember extends Model
{
     protected $table = "pendingmember";
      protected $fillable = [
        'academic_id',
        'name',
        'email',
        'mobile',
        'admission_year',
        'graduation_year',
        'department',
        'final_result',
        'status',
        'company',
        'job',
        'password',
        'member_status',
    ];

    protected $hidden = [
        'password',
    ];

}
