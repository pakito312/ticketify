<?php 

namespace Paki\Ticketify\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'priority', 'status', 'user_id'];
    public const STATUS_OPEN = 'open';
    public const STATUS_RESOLVED = 'resolved';
    public const STATUS_CLOSED = 'closed';

    public static function statuses()
    {
        return [
            self::STATUS_OPEN => 'Ouvert',
            self::STATUS_RESOLVED => 'Résolu',
            self::STATUS_CLOSED => 'Clôturé',
        ];
    }
    
    public function user()
    {
        $userModel = config('ticketify.user_model');
        return $this->belongsTo($userModel);
    }

    public function replies()
    {
        return $this->hasMany(TicketReply::class);
    }

}
