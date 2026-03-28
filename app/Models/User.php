<?php

namespace App\Models;

use App\Models\Traits\HasProfilePhoto;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;


    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'full_name','role_name','profile_photo_url',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'username',
        'city',
        'email',
        'phone',
        'password',
        'user_id',
        'provider',
        'provider_id',
        'address',
        'father_name',
        'post_office',
        'ps',
        'district',
        'city_id',
        'state_id',
        'pin_code',
        'country_id',
        'bank_name',
        'branch_name',
        'account_no',
        'ifsc_code',
        'company_name',
        'profile_photo_path',
        'board_id',
        'board_class_id',
        'class_group_id',
        'user_referral_code',
        'referral_code',
        'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function getRoleNameAttribute()
    {
        if($this->roles()->exists())
            return $this->roles()->first()->name;
        else
            return 0;
    }
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
    public function payment()
    {
        $today = date('Y-m-d');
        return $this->hasOne(Payment::class)->latest()->where('expiry_date','>=', $today);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function group()
    {
        return $this->belongsTo(ClassGroup::class, 'class_group_id');
    }
    public function board()
    {
        return $this->belongsTo(Board::class);
    }
    public function class()
    {
        return $this->belongsTo(BoardClass::class, 'board_class_id');
    }

}
