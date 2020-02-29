<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller {

    public static $data;

    public function __construct() {
        self::$data['title'] = 'AsiBuy CRM '; // always show on title
    }

}
