<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Session;
use DateTime;

class Handle extends Model {

    // Defines relationship
    public function ticket() {
        return $this->belongsTo(Ticket::class);
    }

    // Defines relationship
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Save new handle to DB
    public static function NewHandle($request) {
        $handle = new self();

        $handle->headline = $request->headline;
        $handle->handle = $request->handle;
        $handle->ticket_id = $request->ticket_id;
        $handle->user_id = session::get('user_id');

        $handle->created_at = new DateTime();
        $handle->updated_at = new DateTime();

        $handle->save();

        if ($handle->id) {
            return true;
        }
        return false;

    }

    // save updated to handle
    public static function UpdateHandle($request, $id){

        if ($handle = self::find($id)) {
            $handle->headline = $request->headline;
            $handle->handle = $request->handle;

            $handle->updated_at = new DateTime();

            if ($handle->save()) {
                return true;
            }
        }
        return false;

    }

    // deletes handle
    public static function DeleteHandle($id) {
        $handle = self::find($id);

        if ($handle->delete()) {
            return true;
        }
        return false;
    }



}
