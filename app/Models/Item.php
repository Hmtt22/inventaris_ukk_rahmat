<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name',
        'total_stock',
        'total_repaired',
        'total_borrowed',
        'category_id',
    ];

    // RELASI ke category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}