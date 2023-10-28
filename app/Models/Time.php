<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Time extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'time','description'];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
