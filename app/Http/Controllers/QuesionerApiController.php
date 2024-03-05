<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\PaketKuesioner;
use App\Models\QuesionerJurusan;
use App\Models\QuisionerProdi;
use Illuminate\Http\Request;

class QuesionerApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PaketKuesioner::with("prodi")->get();
        return ResponseHelper::successResponse('success fetch data', $data, 200);
    }

    public function getJurusan()
    {
        $data = QuesionerJurusan::all();
        return ResponseHelper::successResponse('success fetch data', $data, 200);
    }

    public function getProdi()
    {
        $data = QuisionerProdi::all();
        return ResponseHelper::successResponse('success fetch data', $data, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = PaketKuesioner::with(["prodi", "detail.tipe"])->where("id", $request->id_paket_kuesioner)->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = PaketKuesioner::with(["prodi", "detail.tipe"])->where("id", $id)->get();
        return ResponseHelper::successResponse('success fetch data', $data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
