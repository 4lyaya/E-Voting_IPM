<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['nis', 'name', 'has_voted'];

    public function vote()
    {
        return $this->hasOne(Vote::class);
    }
}