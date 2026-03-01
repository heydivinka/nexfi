<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = ['nama', 'email', 'foto', 'rating', 'isi', 'status'];
}