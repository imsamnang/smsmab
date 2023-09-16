<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
  use HasFactory;

  protected $table = 'statuses';

  protected $fillable = ['student_id','class_id'];

  protected $primaryKey = 'status_id';
}