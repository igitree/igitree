<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Members;
use App\Traits\Uuids;

class Family extends Model
{
    use HasFactory;
    use Uuids;
    protected $primaryKey = 'f_id';
    public $timestamps = false;
    public $incrementing = false;
    protected $table='tbl_family';
    protected $fillable=['f_id','f_fathers','f_mothers','f_husbands','f_wives','f_fullname','f_gender','f_indentity'];
    public function user()
    {
      return $this->hasMany(User::class,'u_id');
    }
    
     
}
