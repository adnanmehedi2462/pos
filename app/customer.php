<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
  protected $fillable=[


 'name','email','address','city','shopname','phone','photo','account_holder','account_number','bank_name','bank_branch'




    ];
}
