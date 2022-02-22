<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Members;
use App\Traits\Uuids;

class NewFamily extends Model
{
    use Uuids; 
    use HasFactory;
    
    protected $primaryKey = 'id';

   
    protected $table='family__creators';
    protected $fillable=['id','user_id'];

    public function familyAdmin()
    {
        return $this->belongsTo(User::class,'u_id');
    }


}
