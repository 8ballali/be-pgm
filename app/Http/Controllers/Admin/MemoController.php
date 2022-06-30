<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\history_memo;
use App\Models\Meeting;
use App\Models\Memo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MemoController extends Controller
{
    public function index()
    {

        $logged_in = Auth::user();
        // dd($logged_in);
        if (Auth::user()->role_id == 1) {
            $roles = Auth::user()->roles->name;
            $name = $roles;
            $memo = Memo::all();
            $meeting = Meeting::all();
            $employee = Employee::all();
            $employee_name = Employee::all();

        }else {
            $employee_name = Employee::where('user_id', $logged_in->id)->select('name','dept_id')->get();
            $name = $employee_name[0]->name;
            // dd($name);
            $employee = Employee::where('user_id',auth()->user()->id)->first();
            $memo = Memo::where('employee_id_pengirim', $employee->id)->orWhere('employee_id_penerima', $employee->id)->get();
            $meeting = Meeting::all();
            $employee_name = Employee::all();

        }

        return view('admin.memo', compact('name', 'memo', 'meeting', 'employee','employee_name', 'logged_in'));
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $rules = [
            'employee_id_pengirim' => 'required',
            'employee_id_penerima' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required',
            'status' => 'required',
        ];
        // dd($data);
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $memo = Memo::create($data);

        history_memo::create([
            'memo_id' => $memo->id,
            'catatan' => $request->catatan,
            'bukti' => $request->bukti,
        ]);

        return redirect('/memo');
    }
}
