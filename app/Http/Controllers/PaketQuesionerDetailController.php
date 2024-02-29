<?php

namespace App\Http\Controllers;

use App\Models\OptionJawaban;
use App\Models\PaketKuesioner;
use App\Models\PaketQuesionerDetail;
use App\Models\QuesionerType;
use Doctrine\DBAL\Result;
use Illuminate\Http\Request;

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
        $PaketQuesionerFailed = 0;
        try {
            PaketQuesionerDetail::create([
                'kode_pertanyaan' => $request->items["kodePertanyaan"],
                'pertanyaan' => $request->items["pertanyaan"],
                'tipe_id' => (int) $request->items["tipeJawaban"],
                'id_paket_quesioners' => (int) $request->items["id_paket_quesioners"],
                'is_required' => $request->items["isRequired"],
                'options' => isset($request->items["optionInput"]) ? json_encode($request->items["optionInput"]) : null,
                'index' => $request->items["index"],
            ]);
        } catch (\Throwable $th) {
            $PaketQuesionerFailed++;
        }

        return response()->json([
            "status" => 200,
            "message" => "Insert telah selesai!",
            "error" => [
                "OptionJawaban" => $PaketQuesionerFailed
            ]
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
        //
    }

    public function update_index(Request $request)
    {
        $failurCount = 0;

        foreach ($request->items as  $item) {
            try {
                PaketQuesionerDetail::where('id', $item['id'])->update([
                    "index" => $item['index']
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
