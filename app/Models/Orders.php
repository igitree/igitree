<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;
 
class Orders extends Model
{   
    use Uuids;
    use HasFactory,SoftDeletes;
     protected $primaryKey = 'o_id';
   public $incrementing = false;
    protected $table='tbl_orders';
    protected $fillable=['o_id','o_uid','o_fullname','o_address','o_phoneline','o_email','o_status','o_notes','o_amount'];

 









}
