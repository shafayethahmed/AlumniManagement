<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
     protected $fillable = [
        'user_id',
        'academic_id',
        'mobile',
        'admission_year',
        'graduation_year',
        'department',
        'cgpa',
        'status',
    ];
    

   //Profile Model Relation:
   public function user(){
    return $this->belongsTo(User::class,'user_id');
   }


}
