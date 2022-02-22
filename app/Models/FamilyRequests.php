<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class FamilyRequests extends Model
{
    use HasFactory;
    use Uuids;  

    protected $primaryKey = 'id'; 
    protected $table='family_requests';
    protected $fillable=['id','family_id','user_requested','accepted','relation','to'];

}
