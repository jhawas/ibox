<?php

namespace App\Http\Controllers;

use App\TypeOfTest;
use Illuminate\Http\Request;

class TypeOfTestController extends Controller
{
    public $page = 'Type Of Laboratory Test';
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
        $typeOfTests = TypeOfTest::all();
        return view('admin.typeOfTests.index', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'typeOfTests' => $typeOfTests
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.typeOfTests.create', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
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
        $typeOfTest = new TypeOfTest;
        $typeOfTest->code = $request->code;
        $typeOfTest->description = $request->description;
        $typeOfTest->save();
        return redirect()->route('typeOfTests.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TypeOfTest  $typeOfTest
     * @return \Illuminate\Http\Response
     */
    public function show(TypeOfTest $typeOfTest)
    {
        return view('admin.typeOfTests.show', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'typeOfTest' => $typeOfTest,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TypeOfTest  $typeOfTest
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeOfTest $typeOfTest)
    {
        return view('admin.typeOfTests.edit', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'typeOfTest' => $typeOfTest,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TypeOfTest  $typeOfTest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeOfTest $typeOfTest)
    {
        $typeOfTest->code = $request->code;
        $typeOfTest->description = $request->description;
        $typeOfTest->save();
        return redirect()->route('typeOfTests.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TypeOfTest  $typeOfTest
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeOfTest $typeOfTest)
    {
        $typeOfTest->delete();
        return redirect()->route('typeOfTests.index');
    }
}
