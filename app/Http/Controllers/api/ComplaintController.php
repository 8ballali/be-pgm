<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ComplaintResource;
use Illuminate\Http\Request;
use App\Models\Complaint;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;

class ComplaintController extends Controller
{
    public function index()
    {
        $complaint = Complaint::all();
        $response = [
            'success' => true,
            'message' => 'Data Complaint',
            'data' => $complaint
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    public function show($id)
    {
        $complaint = Complaint::find($id);
        if ($complaint) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Complaint',
                'data' => new ComplaintResource($complaint)
            ],200);
        }else {
            return response()->json([
                'success' => false,
                'message' => 'Data Not Found',
                'data' => []
            ],404);;
        }
    }

    public function add(Request $request)
    {
        $data = $request->all();
        $rules = [
            'cust_id'=> 'required',
            'category_id'=> 'required',
            'type'=> 'required',
            'judul'=> 'required',
            'deskripsi'=> 'required',
            'tanggal'=> 'required',
            'bukti'=> 'required',
        ];
        $bukti = null;
        if ($request->bukti instanceof UploadedFile) {
            $bukti = $request->bukti->store('bukti', 'public');
            $data['bukti'] = $bukti;
        }else{
            unset($data['bukti']);
        }
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $complaint = Complaint::create([
            'cust_id' => $request->cust_id,
            'category_id' => $request->category_id,
            'type' => $request->type,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'status' => 'Terkirim',
            'bukti' => $bukti,
        ]);
        $response = [
            'success'      => true,
            'message'    => 'Data Complaint Created',
            'data'      => $complaint,
        ];
        return response()->json($response, Response::HTTP_CREATED);
    }

}
