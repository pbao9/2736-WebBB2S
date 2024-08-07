<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contact';

    protected $guarded = [];

    public function schools()
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }

    public function countContact()
    {
        return $this->model->count();
    }

    public function scopeContactPending($query)
    {
        return $query->where('status', 0);
    }

}
