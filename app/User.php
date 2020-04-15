<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    // protected $fillable = [
    //     'first_name',
    //     'last_name',
    //     'email',
    //     'phone',
    //     'city',
    // ];
}
