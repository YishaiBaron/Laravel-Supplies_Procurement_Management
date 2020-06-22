<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    protected $fillable = ['name','phone_number','chain','address'];

    public function employees()
    {
        return $this->hasMany('App\Employee');
    }

}
