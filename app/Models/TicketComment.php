<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $ticket_id
 * @property int|null $employee_profile_id
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketComment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketComment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketComment whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketComment whereEmployeeProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketComment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketComment whereTicketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketComment whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Attachment> $attachments
 * @property-read int|null $attachments_count
 * @property-read \App\Models\EmployeeProfile|null $employeeProfile
 * @property-read \App\Models\Ticket $ticket
 * @mixin \Eloquent
 */
class TicketComment extends Model
{
    protected $fillable = [
        'ticket_id',
        'employee_profile_id',
        'content'
    ];

    public function attachments() {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function employeeProfile()
    {
        return $this->belongsTo(EmployeeProfile::class);
    }
}
