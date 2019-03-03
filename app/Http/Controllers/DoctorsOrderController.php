<?php

namespace App\Http\Controllers;

use App\DoctorsOrder;
use App\PatientRecord;
use App\User;
use Illuminate\Http\Request;

class DoctorsOrderController extends Controller
{
    public $page = "Doctor's Order";
    public $description = 'List of all ';

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
        $doctorsOrders = DoctorsOrder::all();
        return view('admin.doctorsOrders.index', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'doctorsOrders' => $doctorsOrders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patientRecords = PatientRecord::with([
            'patient'
        ])->where('discharged', 0)->get();
        $doctors = User::all();
        return view('admin.doctorsOrders.create', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'patientRecords' => $patientRecords,
            'doctors' => $doctors
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $doctorsOrder = new DoctorsOrder;
        $doctorsOrder->patient_record_id = $request->patientRecord;
        $doctorsOrder->date = $request->date;
        $doctorsOrder->time = $request->time;
        $doctorsOrder->progress_note = $request->progress_note;
        $doctorsOrder->doctors_orders = $request->doctors_orders;
        $doctorsOrder->physician_id = \Auth::user()->id;
        $doctorsOrder->save();
        return redirect()->route('doctorsOrders.index');    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DoctorsOrder  $doctorsOrder
     * @return \Illuminate\Http\Response
     */
    public function show(DoctorsOrder $doctorsOrder)
    {
        return view('admin.doctorsOrders.show', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'doctorsOrder' => $doctorsOrder,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DoctorsOrder  $doctorsOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(DoctorsOrder $doctorsOrder)
    {
        $patientRecords = PatientRecord::with([
            'patient'
        ])->where('discharged', 0)->get();
        $doctors = User::all();
        return view('admin.doctorsOrders.edit', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'doctorsOrder' => $doctorsOrder,
            'patientRecords' => $patientRecords,
            'doctors' => $doctors,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DoctorsOrder  $doctorsOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DoctorsOrder $doctorsOrder)
    {
        $doctorsOrder->patient_record_id = $request->patientRecord;
        $doctorsOrder->date = $request->date;
        $doctorsOrder->time = $request->time;
        $doctorsOrder->progress_note = $request->progress_note;
        $doctorsOrder->doctors_orders = $request->doctors_orders;
        $doctorsOrder->physician_id = \Auth::user()->id;
        $doctorsOrder->save();
        return redirect()->route('doctorsOrders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DoctorsOrder  $doctorsOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(DoctorsOrder $doctorsOrder)
    {
        $doctorsOrder->delete();
        return redirect()->route('doctorsOrders.index');
    }
}
