<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\PaketKuesioner;
use App\Models\PaketQuesionerDetail;
use App\Models\QuesionerJurusan;
use App\Models\QuisionerProdi;
use Illuminate\Http\Request;

class QuesionerApiController extends Controller
{
    public function getTracerStudy()
    {
        $data = PaketKuesioner::with("prodi")->where('tipe', 'Tracer Study')->get();
        return ResponseHelper::successResponse('success fetch data', $data, 200);
    }
    public function getSurveyKhususByProdi($id_prodi)
    {
        $data = PaketKuesioner::with("prodi")->where('tipe', 'Survey Khusus')->where('id_quis_identitas_prodi', $id_prodi)->get();
        return ResponseHelper::successResponse('success fetch data', $data, 200);
    }
    public function getDetailById($id_paket)
    {
        $data = PaketQuesionerDetail::with("tipe")->where('id_paket_quesioners', $id_paket)->paginate(5);
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


    public function store(Request $request)
    {
        $data = PaketKuesioner::with(["prodi", "detail.tipe"])->where("id", $request->id_paket_kuesioner)->get();
    }
}
