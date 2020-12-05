<?php

namespace App\Http\Controllers;

use App\DataCovid19;
use App\Kabupaten;
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
        $data=DataCovid19::all();
        return view("datacovid19.index", compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('modify-permission');
        $data=DataCovid19::all();
        $kab=Kabupaten::all();
        return view("datacovid19.create", compact('data', 'kab'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('modify-permission');
        $data = new DataCovid19();
        $data->jenis = $request->get('jenis');
        $data->nama = $request->get('name');
        $data->ktp = $request->get('ktp');
        $data->alamat = $request->get('alamat');
        $data->keluhan_sakit = $request->get('keluhan');
        $data->riwayat_perjalanan = $request->get('riwayat');
        $data->geom = $request->get('geom');

        //LOGO
        $file=$request->file('foto');
        $imgFolder = 'res/foto_covid/';
        $imgFile=time()."_".$file->getClientOriginalName();
        $file->move($imgFolder,$imgFile);
        $data->foto=$imgFile;

        $data->save();

        return redirect()->route('datacovid19.index')->with('status', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DataCovid19  $datacovid19
     * @return \Illuminate\Http\Response
     */
    public function show(DataCovid19 $datacovid19)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DataCovid19  $datacovid19
     * @return \Illuminate\Http\Response
     */
    public function edit(DataCovid19 $datacovid19)
    {
        $this->authorize('modify-permission');
        $data=$datacovid19;
        $kab=Kabupaten::all();
        return view('datacovid19.edit', compact('data', 'kab'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DataCovid19  $datacovid19
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataCovid19 $datacovid19)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DataCovid19  $datacovid19
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataCovid19 $datacovid19)
    {
        //
    }
}
