<?php

namespace App\Http\Controllers;
use App\Models\Departemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
class DepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departemen = Departemen::all();
        $response = [
            'success' => true,
            'message' => 'Data Departement',
            'data' => $departemen
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:191'
        ]);

        $departemen = new Departemen;
        $departemen-> name = $request ->name;
        $departemen->save();
        return response()->json(['message'=>'Departement Added Successfully'],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $departemen = Departemen::find($id);
        if ($departemen) {
            return response()->json([
                'success' => true,
                'message' => "Data Departement",
                'data'    => $departemen
            ],200);
        }else {
            return response()->json([
                'success' => false,
                'message' => "Data Not Found",
                'data' => []
            ],404);
        }
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
    public function update(Request $request, Departemen $departemen)
    {
        $data = $request->all();
        $rules = [
            'name'          => 'required',
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $departemen->update($data);
        $response = [
            'success'   => true,
            'message'   => 'Data Departement Updated',
            'data'      => $departemen,
        ];
        return response()->json($response, Response::HTTP_OK);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $departemen = Departemen::find($id);
        if($departemen)
        {
            $departemen->delete();
            return response()->json(['message'=>'Product Deleted Sucessfully'], 200);
        }else{
            return response()->json(['message'=>'Product Not Found'], 404);
        }
    }
}
