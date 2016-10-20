<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class HomeController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware(['admin', 'permission:admin.home.access']);
    }

    /**
     * Show the admin dashboard
     *  RETURN HOME BY DEFAULT
     * 
     * @return \Illuminate\Http\Response
     */
    public function index() { return $this->home(); }

    /**
     * Show the admin dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function home() {
        return view('areas.admin.home');
    }
}
