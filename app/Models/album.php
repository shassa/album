<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class album extends Model
{
    use HasFactory;
    protected $fillable=['name','user_id'];

    public function pictures(){
        return $this->hasMany(Picture::class);
    }
}
