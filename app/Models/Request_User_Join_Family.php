<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Request_User_Join_Family extends Model
{
    use HasFactory;

    use Uuids;     

    protected $table='request__user__join__families'; 

    protected $primaryKey = 'id'; 

    protected $fillable=['id','request_sent_by','family_id','user_requested','accepted','relation','to'];


}
