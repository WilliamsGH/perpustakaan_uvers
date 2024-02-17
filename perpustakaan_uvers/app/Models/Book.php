<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Book extends Model
{
    use HasFactory;
    
    protected $guarded = [
        'id', 
        'created_at', 
        'updated_at',
    ];
    
    public function borrow()
    {
        return $this->hasMany(BookMove::class);
    }

    public function getStockLeftAttribute()
    {
        $borrowed_stock = $this->borrow()->whereNull('return_date')->count();
        return $this->stock - $borrowed_stock;
    }
    
    public function getDownloadLink()
    {
        if (!$this->file_path) {
            return null;
        }

        $temporaryLink = URL::temporarySignedRoute('download.book', now()->addHour(), ['book' => $this->id]);

        return $temporaryLink;
    }
}
