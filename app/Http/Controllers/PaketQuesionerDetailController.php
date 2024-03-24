<?php

namespace App\Http\Controllers;

use App\Models\OptionJawaban;
use App\Models\PaketKuesioner;
use App\Models\PaketQuesionerDetail;
use App\Models\QuesionerAnswer;
use App\Models\QuesionerAnswerDetail;
use App\Models\QuesionerJurusan;
use App\Models\QuesionerType;
use App\Models\QuisionerIdentitas;
use App\Models\QuisionerProdi;
use Doctrine\DBAL\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PaketQuesionerDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data = PaketQuesionerDetail::with('tipe')->where("id_paket_quesioners", $id)->orderBy('index', 'ASC')
            ->get();
        $lastIndex = $data->last();
        return response()->json([$data, $lastIndex], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
            $latestDetail = QuesionerAnswerDetail::where('user_id', $request->user_id)
                ->orderBy('id', 'desc')
                ->first();

            $count = "";
            if (isset($latestDetail)) {
                if ($latestDetail->level == "6") {
                    $count = "12";
                } else {
                    $count = "6";
                }
            } else {
                $count = "0";
            }

            $detail = QuesionerAnswerDetail::create([
                "user_id" => $request->user_id,
                "id_paket_kuesioner" => $request->id_paket_kuesioner,
                "level" => $count
            ]);

            $detail_id = $detail->id;

            foreach ($data[0]->detail as $res) {
                $id_paket_quesioner_detail = $res->id;
                $kode_pertanyaan = $res->kode_pertanyaan;
                QuesionerAnswer::create([
                    "quesioner_answer_detail_id" => $detail_id,
                    "id_paket_quesioner_detail" => $id_paket_quesioner_detail,
                    "answer_value" => json_encode($request->$kode_pertanyaan),
                ]);
            }
            return redirect()->route('quisioner-index')->with('success', 'Jawaban telah tersimpan!!');
        } catch (\Throwable $th) {
            return redirect()->route('paket_kuesioner.index')->withInput()->with('error', $th->getMessage())->withInput();
        }
        // return $request;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $detail = PaketQuesionerDetail::create([
            'kode_pertanyaan' => $request->items["kodePertanyaan"],
            'pertanyaan' => $request->items["pertanyaan"],
            'tipe_id' => (int) $request->items["tipeJawaban"],
            'id_paket_quesioners' => (int) $request->items["id_paket_quesioners"],
            'is_required' => $request->items["isRequired"],
            'options' => isset($request->items["optionInput"]) ? json_encode($request->items["optionInput"]) : null,
            'index' => $request->items["index"],
        ]);

        $id = $detail->id;

        $data = PaketQuesionerDetail::with('tipe')->where("id", $id)->get();

        return response()->json([
            "status" => 200,
            "message" => "Insert telah selesai!",
            "data" => $data,
            "newId" => $id
        ], 200);
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
        $prodi = QuisionerProdi::all();
        $jurusan = QuesionerJurusan::all();
        return view('admin.paket_kuesioner.test-form', compact(['data', 'prodi', 'jurusan']));
    }

    public function update_index(Request $request)
    {
        $failurCount = 0;

        foreach ($request->items as  $item) {

            try {
                PaketQuesionerDetail::where('id', $item['id'])->update([
                    "index" => $item["index"]
                ]);
            } catch (\Throwable $th) {
                $failurCount++;
            }
        }


        return response()->json([
            "status" => 200,
            "message" => "Data selesai di Update!",
            "failure" => $failurCount,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = PaketQuesionerDetail::with(['tipe'])->where("id", $id)->first();

        return response()->json($data, 200);
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
        PaketQuesionerDetail::where("id", $id)->update([
            "kode_pertanyaan" => $request->items["kodePertanyaan"],
            "pertanyaan" => $request->items["pertanyaan"],
            "tipe_id" => $request->items["tipeJawaban"],
            "is_required" => $request->items["isRequired"],
            "options" => isset($request->items["optionInput"]) ? json_encode($request->items["optionInput"]) : null
        ]);

        return response()->json([
            "status" => 200,
            "message" => "Update data telah selesai!",
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PaketQuesionerDetail::where("id", $id)->delete();

        return response()->json([
            "status" => 200,
            "message" => "Data berhasil Di Hapus!!"
        ], 200);
    }
}
