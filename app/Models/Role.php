<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use RichanFongdasen\EloquentBlameable\BlameableTrait;

class Role extends Model
{
    use HasFactory, BlameableTrait;

    const DEFAULT_ROLE = "administrator";
    const DEFAULT_ADMIN_ROLE_ID = 1;
    const ROLE_ACTIVE = true;
    const ROLE_INACTIVE = false;

    protected $table = 'roles';
    protected $fillable = ['name','ident', 'description', 'active'];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions', 'role_id', 'permission_id');
    }

    public function hasPermission($id)
    {
        return((bool) DB::table('role_permissions')
            ->select('role_id')
            ->where('role_id', $this->id)
            ->where('permission_id', $id)
            ->get()
            ->first());
    }
    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }

}
