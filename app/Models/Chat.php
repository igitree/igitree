<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; 
use App\Traits\Uuids;

class Chat extends Model
{

    use Uuids;
    protected $primaryKey = 'c_id';
    protected $table='tbl_chats';
    protected $fillable=[
                        'c_id',
                        'c_sender',
                        'c_recipient',
                        'c_message',
                        'c_image',
                        'c_document',
                        'c_date',
                        'c_device',
                        'c_os_type',
                        'c_status'];
    use HasFactory;
    
    // public $timestamps = false;
    protected $dates = [
    'c_date', 
    // your other new column
];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function father()
    {
        $this->father=User::where('f_id',auth()->user()->u_id);

    }
}
