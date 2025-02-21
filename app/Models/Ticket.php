<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function category()
    {
        return $this->belongsTo(Category::class, 'categorie_id');
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    protected $fillable = ['title', 'description', 'status', 'user_id', 'categorie_id', 'agent_id'];
}
