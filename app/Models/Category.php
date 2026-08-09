<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    protected $fillable = ['slug','name_uk','name_es','description_uk','description_es','icon','sort_order'];
    public function products(): BelongsToMany { return $this->belongsToMany(Product::class); }
    public function getNameAttribute(): string { return $this->{'name_'.app()->getLocale()} ?: $this->name_uk; }
    public function getDescriptionAttribute(): string { return $this->{'description_'.app()->getLocale()} ?: $this->description_uk; }
}
