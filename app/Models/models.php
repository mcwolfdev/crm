<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class models extends Model
{
    use HasFactory;
    protected $fillable = ['name'];



    public function Brand(){
        return $this->hasOne(brand::class, 'id', 'brand_id');
    }


}
