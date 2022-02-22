<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Family;
use App\Models\ALbums;
use App\Models\Chat;
use App\Models\Status; 
use App\Traits\Uuids; 
use App\Models\NewFamily;
class User extends Authenticatable
{
    use Uuids;
   

    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $table = 'tbl_users';
    protected $primaryKey = 'u_id';
    public $timestamps = false;
    protected $fillable = [
       'u_id',
        'u_fullname', 
        'u_dob',
        'u_address', 
        'u_email',
        'u_password', 
        'u_phoneline',
        'u_gender',
        'u_country',  
        'u_verification_code',
        'u_status',
        'oauth_id',
        'oauth_type',
        'aactive_status',
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'u_password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

   
    public function albums()
    {
        return $this->hasMany(ALbums::class, 'user_id');
    }

    public function chat()
    {
        return $this->hasMany(Chat::class, 'c_recipient');
       
    }
    

    public function status()
    {
        return $this->hasMany(Status::class, 'user_id');    
    }

    public function family()
    {
        return $this->belongsTo(Family::class,'f_id');
    }

    public function UserFamilyIsAdmin()
    {
        return $this->hasOne(NewFamily::class, 'user_id');
    }

     }
