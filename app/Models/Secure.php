<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Secure extends Model
{ 
    protected $guarded = ['id'];
    protected $table = "secure";

}