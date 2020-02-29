<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Session;
use DateTime;

class Ticket extends Model {

    // Defines relationship
    public function handles() {
        return $this->hasMany(Handle::class);
    }

    // Defines relationship
    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    // Defines relationship
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Get tickets order by date and paginated
    public static function GetTickets() {
        $tickets = self::latest()->paginate(5);
        return $tickets;
    }

    // Save new ticket to DB
    public static function NewTicket($request) {
        $ticket = new self();

        $ticket->subject = $request->subject;
        $ticket->ticket = $request->ticket;
        $ticket->customer_id = $request->customer_id;
        $ticket->user_id = session::get('user_id');

        $ticket->created_at = new DateTime();
        $ticket->updated_at = new DateTime();

        $ticket->save();

        if ($ticket->id) {
            return true;
        }
        return false;

    }

    // save updated to ticket
    public static function UpdateTicket($request, $id){

        if ($ticket = self::find($id)) {
            $ticket->subject = $request->subject;
            $ticket->ticket = $request->ticket;

            $ticket->updated_at = new DateTime();

            if ($ticket->save()) {
                return true;
            }
        }
        return false;

    }

    // deletes ticket
    public static function DeleteTicket($id) {
        $ticket = self::find($id);

        if ($ticket->delete()) {
            if (Handle::where('ticket_id', $id)->delete()) { // deleted all ticket's handles
                return true;
            }
        }
        return false;
    }

    // change ticket status
    public static function changeStatus($id) {

        if ($ticket = self::find($id)) {

            $current_status = $ticket->status;

            if ($current_status == 1) {
                $ticket->status = 0;
            } else if ($current_status == 0) {
                $ticket->status = 1;
            }

            $ticket->updated_at = new DateTime();

            if ($ticket->save()) {
                return true;
            }
        }
        return false;

    }


}
