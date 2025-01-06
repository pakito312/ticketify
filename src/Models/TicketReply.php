<?php 

namespace Paki\Ticketify\Models;

use Illuminate\Database\Eloquent\Model;

class TicketReply extends Model
{
    protected $fillable = ['ticket_id', 'user_id', 'message'];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
        $userModel = config('ticketify.user_model');
        return $this->belongsTo($userModel);
    }
}
