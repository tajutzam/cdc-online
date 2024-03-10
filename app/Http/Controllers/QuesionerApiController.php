<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\PaketKuesioner;
use App\Models\PaketQuesionerDetail;
use App\Models\QuesionerAnswer;
use App\Models\QuesionerAnswerDetail;
use App\Models\QuesionerJurusan;
use App\Models\QuisionerProdi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class QuesionerApiController extends Controller
{
    public function getTracerStudy()
    {
        $data = PaketKuesioner::where('tipe', 'Tracer Study')->get();
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

        $validationData = [];
        foreach ($data[0]->detail as $res) {
            $validationData[$res->kode_pertanyaan] = $res->is_required == "1" ? "required" : "";
        }
        $messages = [
            'required' => 'This :attribute field is required.',
        ];

        $request->validate($validationData, $messages);

        $detail = QuesionerAnswerDetail::create([
            "user_id" => $request->user_id,
            "id_paket_kuesioner" => $request->id_paket_kuesioner,
        ]);

        $detail_id = $detail->id;

        try {
            foreach ($data[0]->detail as $res) {
                $id_paket_quesioner_detail = $res->id;
                $kode_pertanyaan = $res->kode_pertanyaan;
                QuesionerAnswer::create([
                    "quesioner_answer_detail_id" => $detail_id,
                    "id_paket_quesioner_detail" => $id_paket_quesioner_detail,
                    "answer_value" => json_encode($request->$kode_pertanyaan),
                ]);
            }
            return ResponseHelper::successResponse('Success submited quesioner', "", 200);
        } catch (\Throwable $th) {
            return ResponseHelper::successResponse('Failed submited quesioner', $th->getMessage(), 200);
        }
    }

    public function cekStatusKuesionerUser($user_id, $id_paket)
    {
        //status 1: boleh mengisi
        //status 2: tidak bisa mengisi

        $jenisQuesioner = PaketKuesioner::where('id', $id_paket)->first()->tipe;

        if ($jenisQuesioner == "Tracer Study") {
            //tracer study di isi 3 kali (bulan 1, bulan 6, bulan 12)
            //apakah sudah mengisi?
            $cekTracerStudy = QuesionerAnswerDetail::where('user_id', $user_id)
                ->where('id_paket_kuesioner', $id_paket)->count();
            if ($cekTracerStudy > 0) {
                //jika sudah
                if ($cekTracerStudy >= 3) {
                    //sudah mengisi 3 kali
                    $created_at_terakhir = QuesionerAnswerDetail::where('user_id', $user_id)
                        ->where('id_paket_kuesioner', $id_paket)->latest('id')->first()->created_at;
                    return response()->json([
                        'status' => 0,
                        'message' => Carbon::parse($created_at_terakhir)->toDateTimeString() . "Anda Sudah Mengisi kuesioner ke ke 3"
                    ], 200);
                } else {
                    //baru mengisi 1 atau 2
                    //cek bulan pengisian terakhir, apakah jika ditambah 3 bulan sudah sama denga bulan sekarang
                    $created_at_terakhir = QuesionerAnswerDetail::where('user_id', $user_id)
                        ->where('id_paket_kuesioner', $id_paket)->latest('id')->first()->created_at;

                    $JadwalMengisi = Carbon::parse($created_at_terakhir)->addMonths(6);
                    $current_date_time = Carbon::now();
                    if ($current_date_time->gte($JadwalMengisi)) {
                        return response()->json([
                            'status' => 1,
                            'message' => $JadwalMengisi->toDateTimeString() . " Sudah saatnya mengis kuesioner kembali!"
                        ], 200);
                    } else {
                        return response()->json([
                            'status' => 0,
                            'message' => $JadwalMengisi->toDateTimeString() . " Belum Waktunya mengisi kuesioner kembali!"
                        ], 200);
                    }
                }
            } else {
                //jka belum
                //megnisi yang pertama
                return response()->json([
                    'status' => 1,
                    'message' => "Anda Belum mengisi kuesioner tracer study ini untuk yang pertama"
                ], 200);
            }
        } else {
            //survey khsuus di isi 1 kali
            $cekSurveyKhusus = QuesionerAnswerDetail::where('user_id', $user_id)
                ->where('id_paket_kuesioner', $id_paket)->count();
            if ($cekSurveyKhusus < 1) {
                return response()->json([
                    'status' => 1,
                    'message' => "Anda Belum mengisi quesioner ini"
                ], 200);
            } else {
                return response()->json([
                    'status' => 0,
                    'message' => "Anda Sudah mengisi quesioner ini"
                ], 200);
            }
        }
    }
}
