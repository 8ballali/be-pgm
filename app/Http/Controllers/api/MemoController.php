<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Memo1Resource;
use App\Http\Resources\MemoResource;
use App\Models\Memo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MemoController extends Controller
{
    public function index()
    {

    }
    public function add(Request $request)
    {
        $this->validate($request, [
            'employee_id_pengirim' => 'required',
            'employee_id_penerima' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required',
            'status' => 'required',

        ]);
        $memo = Memo::create([
            'employee_id_pengirim' => $request->employee_id_pengirim,
            'employee_id_penerima' => $request->employee_id_penerima,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'meeting_id' => $request->meeting_id,
            'status' => $request->status,
        ]);
        if ($request->meeting_id == null) {
            $response = [
                'success'      => true,
                'message'    => 'Data Department Created',
                'data'      => new Memo1Resource($memo),
            ];
        return response()->json($response, Response::HTTP_CREATED);
        }
        $response = [
            'success'      => true,
            'message'    => 'Data Department Created',
            'data'      => new MemoResource($memo),
        ];
        return response()->json($response, Response::HTTP_CREATED);
    }
}
