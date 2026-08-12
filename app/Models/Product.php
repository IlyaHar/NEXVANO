<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    protected $fillable = ['slug','title_uk','title_es','subtitle_uk','subtitle_es','description_uk','description_es','benefits_uk','benefits_es','composition_uk','composition_es','application_uk','application_es','image','volume','featured','is_active','sort_order'];
    protected $casts = ['featured' => 'boolean', 'is_active' => 'boolean'];

    public function categories(): BelongsToMany { return $this->belongsToMany(Category::class); }
    public function scopeActive(Builder $q): Builder { return $q->where('is_active', true)->orderBy('sort_order'); }
    public function scopeFeatured(Builder $q): Builder { return $q->where('featured', true); }
    public function getTitleAttribute(): string { return $this->{'title_'.app()->getLocale()} ?: $this->title_uk; }
    public function getSubtitleAttribute(): ?string { return $this->{'subtitle_'.app()->getLocale()} ?: $this->subtitle_uk; }
    public function getDescriptionAttribute(): string { return $this->{'description_'.app()->getLocale()} ?: $this->description_uk; }
    public function getBenefitsAttribute(): ?string { return $this->{'benefits_'.app()->getLocale()} ?: $this->benefits_uk; }
    public function getCompositionAttribute(): ?string { return $this->{'composition_'.app()->getLocale()} ?: $this->composition_uk; }
    public function getApplicationAttribute(): ?string { return $this->{'application_'.app()->getLocale()} ?: $this->application_uk; }
    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image) return null;

        return str_starts_with($this->image, 'images/')
            ? '/'.ltrim($this->image, '/')
            : route('product-images.show', ['path' => $this->image], false);
    }

    public static function textBlocks(?string $text): array
    {
        $text = trim(preg_replace("/\r\n?|\x{2028}|\x{2029}/u", "\n", (string) $text));
        if ($text === '') return [];

        $text = preg_replace('/\s+(?=[\x{1F300}-\x{1FAFF}])/u', "\n", $text);
        $labels = [
            'Вміст діючих компонентів', 'Склад (г/л маси)', 'Позакореневе підживлення', 'Обробка насіння',
            'Рекомендовані фази внесення', 'Для максимальної ефективності', 'Спосіб застосування', 'Сумісність',
            'Contenido de componentes activos', 'Composición', 'Aplicación foliar', 'Tratamiento de semillas', 'Fases recomendadas', 'Modo de aplicación', 'Compatibilidad',
        ];
        $labels = array_map(fn (string $label) => preg_quote($label, '/'), $labels);
        $text = preg_replace('/\s+(?=(?:'.implode('|', $labels).')\s*:)/ui', "\n", $text);
        $lines = preg_split('/\n+/', $text, -1, PREG_SPLIT_NO_EMPTY);
        $blocks = [];

        foreach ($lines as $line) {
            $sentences = preg_split('/(?<=[.!?])\s+(?=[\p{Lu}\p{Lt}\x{1F300}-\x{1FAFF}])/u', trim($line), -1, PREG_SPLIT_NO_EMPTY);
            array_push($blocks, ...$sentences);
        }

        return array_values(array_filter(array_map('trim', $blocks)));
    }
}
