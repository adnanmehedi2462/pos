<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{

    protected $fillable = [
        'name', 'email', 'phone','address','type','photo','shop','accountholder','accountnumber','bankname','branchname','city'
    ];
}
