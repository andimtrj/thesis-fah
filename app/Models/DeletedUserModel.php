<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeletedUserModel extends Model
{
    use HasFactory;
    protected $table = 'deleted_users';

    protected $fillable = [
        'username',
        'email',
        'role_id',
        'tenant_id',
        'branch_id',
        'deleted_by',
        'deleted_at'
    ];

}
