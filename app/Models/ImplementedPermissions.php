<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImplementedPermissions extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'permission_id'
    ];

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}
