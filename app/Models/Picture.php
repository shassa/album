<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;
    protected $fillable=['name','album_id','file'];

    public function setFileAttribute($val)
    {
        $name=$val->getClientOriginalName();
        $val->move('image',$name);
        $this->attributes['file'] = $name;
    }

}
