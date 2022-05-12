<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = ['company', 'title', 'email', 'website', 'tags', 'location', 'description', 'logo','user_id'];

    public function scopeFilter($query, array $filter)
    {
        if ($filter['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        if ($filter['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%')
                ->orWhere('company', 'like', '%' . request('search') . '%')
                ->orWhere('location', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%');
        }

    }

    // relationship To user
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
