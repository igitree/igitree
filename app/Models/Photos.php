<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;
class Photos extends Model
{
    use HasFactory;
    use Uuids;  
    protected $primaryKey = 'i_id';

    protected $table='tbl_images';

    public $incrementing = false;
    
    protected $fillable=['i_id','i_user','i_image','i_location','i_date','i_device','i_os_type','i_date_added','i_status','album_id','caption'];

     public $timestamps = false;
}
