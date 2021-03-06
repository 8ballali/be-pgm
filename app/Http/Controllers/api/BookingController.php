<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Resource_;

class BookingController extends Controller
{
    public function logCustomer()
    {
        $logged_in = Customer::where('user_id', Auth::user()->id)->first();
        return $logged_in;
    }
    public function index(Request $request)
    {
        $booking = Booking::with('customer.user','product','status_booking')->
        where('cust_id', $this->logCustomer()->id)->
        when(($request->get('product_id')), function ($query) use ($request)
        {
            $query->where('product_id', $request->product_id);
        })
        ->when(($request->get('status')), function ($query) use ($request)
        {
            $query->where('status', $request->status);
        })->get();
        if ($booking->isNotEmpty()) {
            return response()->json([
                'meta' => [
                    'code'  => 200,
                    'status' => 'success',
                    'message' => 'Data Booking Found'
                ],
                'data' => [
                    'booking' => $booking
                ],
            ]);
        }else {
            return response()->json([
                'meta' => [
                    'code' => 404,
                    'status' => 'Failed',
                    'message' => 'Data Booking Not Found'
                ],
            ]);
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

        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message'    => 'Data Booking Created',
            ],
            'data' => [
                'booking' => $booking
            ]
        ],200);

    }
}
