<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'category_id',
        'title',
        'slug',
        'description',
        'price_regular',
        'price_discount',
        'start_date',
        'end_date',
        'image',
        'views_count',
        'clicks_count',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'price_regular' => 'decimal:2',
        'price_discount' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function isActive()
    {
        $now = Carbon::now();
        return $this->is_active 
            && $this->start_date <= $now 
            && $this->end_date >= $now;
    }

    public function getDiscountPercentageAttribute()
    {
        // Validar que ambos precios existan y sean mayores a 0
        if (!isset($this->price_regular) || !isset($this->price_discount)) {
            return 0;
        }
        
        $priceRegular = (float) $this->price_regular;
        $priceDiscount = (float) $this->price_discount;
        
        // Evitar división por cero
        if ($priceRegular <= 0) {
            return 0;
        }
        
        // Validar que el precio con descuento sea menor o igual al precio regular
        if ($priceDiscount > $priceRegular) {
            return 0;
        }
        
        // Calcular porcentaje de descuento: ((Precio Regular - Precio Descuento) / Precio Regular) * 100
        $discount = (($priceRegular - $priceDiscount) / $priceRegular) * 100;
        
        // Redondear a 0 decimales (porcentaje entero)
        return (int) round($discount, 0);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($promotion) {
            if (empty($promotion->slug)) {
                $promotion->slug = Str::slug($promotion->title);
            }
        });
    }
}
