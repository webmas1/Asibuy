<?php

namespace App;
use Carbon\Carbon;
use DateTime;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model {

    // Defines relationship
    public function tickets() {
        return $this->hasMany(Ticket::class);
    }

    // Get customers order by date and paginated
    public static function GetCustomers() {
        $customers = self::latest()->paginate(10);
        return $customers;
    }

    // Get 5 new customers only
    public static function GetNewCustomers() {
        $customers = self::latest()->take(5)->get();
        return $customers;
    }

    // Save new customer to DB
    public static function NewCustomer($request) {
        $customer = new self();

        $customer->first_name = strtolower($request->first_name);
        $customer->last_name = strtolower($request->last_name);
        $customer->id_number = $request->id_number;
        $customer->email = strtolower($request->email);
        $customer->phone = $request->phone;

        $customer->created_at = new DateTime();
        $customer->updated_at = new DateTime();

        $customer->save();

        if ($customer->id) {
            return true;
        } else {
            return false;
        }
    }

    // save updated to customer
    public static function UpdateCustomer($request, $id) {
        $customer = self::find($id);

        $customer->first_name = strtolower($request->first_name);
        $customer->last_name = strtolower($request->last_name);
        $customer->id_number = $request->id_number;
        $customer->phone = $request->phone;

        $customer->updated_at = new DateTime();

        if ($customer->save()) {
            return true;
        }
    }


}
