<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Resource_;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $booking = Booking::with('status_booking')->with('product')->
        when(($request->get('cust_id')), function ($query) use ($request)
        {
            $query->where('cust_id', $request->cust_id);
        })
        ->when(($request->get('product_id')), function ($query) use ($request)
        {
            $query->where('product_id', $request->product_id);
        })
        ->when(($request->get('status')), function ($query) use ($request)
        {
            $query->where('status', $request->status);
        })->first();
        if ($booking) {
            return response()->json([
                'success' => true,
                'message' => 'Data Booking',
                'data' => new BookingResource($booking)
            ],200);
        }else {
            return response()->json([
                'success' => false,
                'message' => 'Data Booking Not Found',
                'data' => []
            ],404);
        }
    }
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
            'status' => $request->status,
            'bukti' => $bukti,
        ]);
        $response = [
            'success'      => true,
            'message'    => 'Data Booking Created',
            'data'      => $booking,
        ];
        return response()->json($response, Response::HTTP_CREATED);
    }
}
