<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_id';

    protected $fillable = ['user_id', 'image', 'identity', 'identity_image', 'address', 'zip_code', 'state', 'phone', 'gender'];

    protected function getImageUrlAttribute()
    {
        return $this->image != null ? asset('assets/images/profile/' . $this->image) : asset('backend/img/avatars/profile.png');
    }

    protected function getImageIdentityUrlAttribute()
    {
        return $this->identity_image ? asset('assets/images/identity/' . $this->identity_image) : 'javascript:void(0)';
    }
}
