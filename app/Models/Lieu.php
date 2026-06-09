<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lieu extends Model
{
     use HasFactory;
     protected $table = 'lieux';
    protected $fillable = ['nom', 'latitude', 'longitude', 'image', 'type_id'];

public function type()
{
    return $this->belongsTo(Type::class);
}
}
