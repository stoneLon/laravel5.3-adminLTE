<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminUserRole extends Model
{
    protected $table = 'admin_user_role';

    protected $primaryKey = 'admin_user_role_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin_user_id', 'role_id'
    ];

    public function belongsToAdminUser()
    {
        return $this->belongsTo('App\Models\AdminUser', 'admin_user_id');
    }

}
