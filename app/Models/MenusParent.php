<?php

namespace App\Models;

use App\Admin\Traits\Roles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class MenusParent extends Model
{
    use HasFactory, Roles;

    protected $table = 'parents';
    protected $fillable = [
        /** user id */
        'user_id',
    ];
    protected $casts = [];

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'parent_students', 'parent_id', 'student_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function contracts(): HasManyThrough
    {
        return $this->hasManyThrough(
            Contract::class,
            ContractDetail::class,
            'parent_id',
            'id',
            'id',
            'contract_id'
        );
    }

    public function scopeParents($query)
    {
        return $query->whereHas('user.roles', function ($query) {
            $query->where('name', $this->getRoleParent());
        });
    }
}
