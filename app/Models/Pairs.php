<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\User;

class Pairs extends Model {

       protected $fillable = ['bnb','eth','btc'];

}
