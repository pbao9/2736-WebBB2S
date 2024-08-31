<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContractDetail extends Model
{
    use HasFactory;

    protected $table = 'contract_details';

    public $timestamps = false;

    protected $fillable = [
        /** student_id */
        'student_id',
        /** parent_id */
        'parent_id',
        /** contract_id */
        'contract_id',
        /** Thời gian học sinh tới nhà */
        'time_arrive_home',
        /** Thời gian đưa học sinh */
        'time_pick',
        /** Địa điểm đón*/
        'pick_address',
        /** Kinh độ địa điểm đón */
        'longitude',
        /** Vĩ độ địa điểm đón */
        'latitude',
    ];

    protected $casts = [
        'detail' => AsArrayObject::class
    ];

    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(MenusParent::class, 'parent_id');
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
