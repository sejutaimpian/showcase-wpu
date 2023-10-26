<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;

    public function appType(): BelongsTo
    {
        return $this->belongsTo(AppType::class);
    }
    public function time(): BelongsTo
    {
        return $this->belongsTo(Time::class);
    }
    public function teches(): BelongsToMany
    {
        return $this->belongsToMany(Tech::class);
    }
    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(Language::class);
    }
}
