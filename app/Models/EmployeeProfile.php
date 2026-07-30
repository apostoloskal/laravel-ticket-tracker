<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string|null $full_name
 * @property string|null $job_title
 * @property string|null $department
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\EmployeeProfileFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeProfile whereDepartment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeProfile whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeProfile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeProfile whereJobTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeProfile whereUserId($value)
 * @mixin \Eloquent
 */
class EmployeeProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'job_title',
        'department'
    ];

    public function getDisplayNameAttribute()
    {
        return $this->full_name ?: $this->user->username;
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
