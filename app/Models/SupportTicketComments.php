<?php

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Model;
use Vanguard\User;

class SupportTicketComments extends Model
{
    protected $table = 'support_ticket_comment';

    protected $fillable = ['user_id','ticket_id','comment','file'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ticket()
    {
        return $this->belongsTo(SupportTicket::class,'ticket_id');
    }

}
