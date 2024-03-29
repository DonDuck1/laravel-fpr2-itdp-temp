<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    public const IS_USER = 1;
    public const IS_MANAGER = 2;
    public const IS_ADMIN = 3;

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
