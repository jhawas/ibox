<?php

namespace App\Http\Controllers;

use App\PatientRecord;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public $page = 'Billing';
    public $description = 'List of ';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.billings.index', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
        ]);
    }
}
