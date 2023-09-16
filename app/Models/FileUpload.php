<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use File;
class FileUpload extends Model
{
  use HasFactory;

  public static function photo ($request, $filename, $default =""){
    $name = "";
    $photo = $request->photo;
    if($request->hasFile($filename))
    {
      $extension = $photo->getClientOriginalExtension();
      $name = rand(111111,999999)."-".date('Y-m-d')."-".time().".".$extension;
      $photo->move(public_path('uploads/students/'),$name);
      $name= $name;
    }else {
      $name= $default;
    }
    return $name;
  }
}
