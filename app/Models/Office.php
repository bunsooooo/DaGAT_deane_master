<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;

    protected $fillable = ['Office_Name', 'Office_Pin'];

    public function signatories()
    {
        return $this->hasMany(Signatory::class, 'id');
    }
}
