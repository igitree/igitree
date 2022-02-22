<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Photos;
use App\Traits\Uuids;

  
class ALbums extends Model
{
    use HasFactory;
    
    use Uuids;
    protected $primaryKey = 'id';
    protected $table='albums';
    public $incrementing = false;
    protected $fillable = ['id','user_id','title','description'];

     public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function photos()
    {
        return $this->hasMany(Photos::class,'album_id');
    }

}
