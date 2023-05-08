<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function customers()
    {
        return $this->belongsTo(LoanType::class,'loan_type');
    }

   public function getUserNameAttribute()
   {
    $name = $this->name;
    $data =  explode(' ',$name);
    return $data;
   }
}
