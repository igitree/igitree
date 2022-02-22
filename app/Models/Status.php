<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Traits\Uuids;

class Status extends Model
{
    use HasFactory;
    use Uuids;
    protected $table = 'tbl_status';
    protected $primaryKey = 's_id';
    protected $fillable = ['s_id','user_id','family_id','s_image','s_text','s_video'];

    public function user()
    {
        return $this->belongsTo(User::class,'u_id');
    }
    
}
