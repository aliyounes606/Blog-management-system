<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;
    protected $table = 'blogs';
    protected $guarded = [];
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function favoredBy()
    {
        return $this->belongsToMany(User::class, 'favors', 'blog_id', 'user_id');
    }
}
