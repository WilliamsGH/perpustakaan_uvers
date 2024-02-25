<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    protected $guarded = [
        'id', 
        'created_at', 
        'updated_at',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function total_book_borrowed()
    {
        $major_id = $this->id;

        $move_ids = BookMove::whereIn('user_id', function($query) use ($major_id) {
            $query->select('id')->from('users')->where('major_id', $major_id);
        })->get();

        return count($move_ids);
    }
    
    public function total_visitors()
    {
        $major_id = $this->id;

        $history_ids = LoginHistory::whereIn('user_id', function($query) use ($major_id) {
            $query->select('id')->from('users')->where('major_id', $major_id);
        })->get();

        return count($history_ids);
    }
}
