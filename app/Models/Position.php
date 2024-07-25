<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = [
        'name' // Assuming the positions table has a 'name' column
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'position_id', 'id'); // Ensure the foreign key and local key are correctly set
    }
    
}
