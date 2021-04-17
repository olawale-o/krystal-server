<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gig extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable
     * @var array 
     */
    protected $fillable = [
        'role',
        'user_id',
        'company',
        'address',
        'tags',
        'min_salary',
        'max_salary',
        'is_rejected'
    ];

    /**
     * The relationship between Gig and User models
     * @param null
     * @return \App\Model\User|User
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
