<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $fillable = [
            'sso_user_id','name','surname','phone','email','fonction','org_id'
        ];


        protected $hidden = [];
}
