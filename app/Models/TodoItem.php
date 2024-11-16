<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User; 



class TodoItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'user_id'];


    public function user() : BelongsTo 
    {
        $this->belongsTo(User::class); 
    }
}
