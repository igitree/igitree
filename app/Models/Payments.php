<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Payments extends Model
{
    use Uuids;
    use HasFactory;
    protected $table='tbl_payments'; 
    protected $primaryKey = 'p_id';

    protected $fillable=['p_id','p_transaction_id','p_receipt','p_amount','p_currency','p_status','p_time'];
}
