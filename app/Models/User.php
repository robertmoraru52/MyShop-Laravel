<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable implements CanResetPassword
{
    use Notifiable;
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'email','password','remember_token', 'deleted_at', 'is_admin',
    ];

    public function isAdministrator() {
        return $this->where('is_admin', '1')->exists();
     }
} 