<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyClass extends Model
{
  use HasFactory;

  protected $guarded = [];

  protected $primaryKey = 'class_id';

  protected $table = 'classes';
}
