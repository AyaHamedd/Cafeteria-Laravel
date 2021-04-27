<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Notifications\ResetPasswordNotification;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $guarded = [];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    //     'avatar',
    //     'room_id',
    // ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function getTotalUserOrdersPrice(){
        $user_orders = $this->find($this->id)->orders;
        $totalUserOrdersPrice = 0;
        foreach($user_orders as $user_order){
            $totalUserOrdersPrice += $user_order->getTotalOrderPrice();
        }
        return $totalUserOrdersPrice;
    }

    public function socialAccounts(){
        return $this->hasMany(SocialAccount::class);
    }

    public function sendPasswordResetNotification($token)
{
    $this->notify(new ResetPasswordNotification($token));
}
}
