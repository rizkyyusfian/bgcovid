<?php

namespace App\Http\Controllers;

use App\DataCovid19;
use Illuminate\Http\Request;
use DB;

class DataCovid19Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Kabupaten::all();
        return view("kabupaten.index", compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('modify-permission');
        $data=Kabupaten::all();
        return view("kabupaten.create", compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DataCovid19  $dataCovid19
     * @return \Illuminate\Http\Response
     */
    public function show(DataCovid19 $dataCovid19)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DataCovid19  $dataCovid19
     * @return \Illuminate\Http\Response
     */
    public function edit(DataCovid19 $dataCovid19)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DataCovid19  $dataCovid19
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataCovid19 $dataCovid19)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DataCovid19  $dataCovid19
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataCovid19 $dataCovid19)
    {
        //
    }
}
