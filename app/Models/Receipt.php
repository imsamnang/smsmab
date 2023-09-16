<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Receipt extends Model
{
    use HasFactory;

    protected $fillable = ['receipt_id'];

    static public function autoNumber()
    {
      $id =0;
      $receiptID = Receipt::max('receipt_id');
      if($receiptID !=0)
      {
        $id= $receiptID+1;
        Receipt::insert(['receipt_id'=>$id]);
      } else {
        $id =1;
        Receipt::insert(['receipt_id'=>$id]);
      }
      return $id;
    }
}
