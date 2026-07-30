<?php

namespace App\Models;

use App\Enums\TicketCategory;
use App\Enums\TicketStatus;
use App\Models\Traits\HasTrackingCode;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Override;

/**
 * @property int $id
 * @property string $uuid
 * @property string $tracking_code
 * @property string $title
 * @property string $description
 * @property TicketCategory $category
 * @property TicketStatus $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereTrackingCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereUuid($value)
 * @property string $email
 * @property int|null $employee_profile_id
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereEmployeeProfileId($value)
 * @property-read \App\Models\EmployeeProfile|null $assignedEmployee
 * @mixin \Eloquent
 */
class Ticket extends Model
{
    use HasFactory, HasUuids, HasTrackingCode;

    public string $trackingPrefix = 'TKT-';

    protected $fillable = [
        'title',
        'description',
        'category',
        'status',
        'email',
        'employee_profile_id'
    ];

    protected function casts(): array
    {
        return [
            'category' => TicketCategory::class,
            'status' => TicketStatus::class
        ];
    }

    public function comments()
    {
        return $this->hasMany(TicketComment::class)->latest();
    }

    public function assignedEmployee()
    {
        return $this->belongsTo(EmployeeProfile::class, 'employee_profile_id');
    }

    public function uniqueIds(): array 
    {
        return ['uuid'];
    }

    #[Override]
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
}
