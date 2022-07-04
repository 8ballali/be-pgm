<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function add(Request $request)
    {
        $data = $request->all();
        $rules = [
            'cust_id'=> 'required',
            'product_id'=> 'required',
            'bukti'=> 'required',
            'status'=> 'required',
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
        $booking = Booking::create([
            'cust_id' => $request->cust_id,
            'product_id' => $request->product_id,
            'bukti' => $bukti,
        ]);
        $response = [
            'success'      => true,
            'message'    => 'Data Complaint Created',
            'data'      => $booking,
        ];
        return response()->json($response, Response::HTTP_CREATED);
    }
}
