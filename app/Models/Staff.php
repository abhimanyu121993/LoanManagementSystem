<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function managers()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function getUserNameAttribute()
   {
    $name = $this->managers->name;
    $data =  explode(' ',$name);
    return $data;
   }
}
