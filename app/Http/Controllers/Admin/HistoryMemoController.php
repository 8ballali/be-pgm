<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use App\Models\history_memo;
use App\Models\Meeting;
use App\Models\Memo;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HistoryMemoController extends Controller
{
    public function index($memo_id){
        $logged_in = Auth::id();
        $history = history_memo::where('memo_id', $memo_id)->get();
        if (Auth::user()->role_id == 1) {
            $roles = Auth::user()->roles->name;
            $name = $roles;
            $memo = Memo::all();
            $meeting = Meeting::all();
            $employee = Employee::all();

        }else {
            $employee_name = Employee::where('user_id', $logged_in)->select('name','dept_id')->get();
            $name = $employee_name[0]->name;
            $employee = Employee::where('user_id',auth()->user()->id)->first();
            $memo = Memo::where('employee_id_pengirim', $employee->id)->orWhere('employee_id_penerima', $employee->id)->get();
            $meeting = Meeting::all();

        }
        return view('admin.history', compact('history', 'name','employee','history', 'memo'));

    }
    public function store(Request $request, $memo_id)
    {
        $history = history_memo::find($memo_id);
        // dd($history);
        $data = $request->all();
        $rules = [
            'catatan' => ['required', 'string', 'max:255'],
            'bukti' => ['required'],
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

         history_memo::create([
            'memo_id' => $history->memo_id,
            'catatan' => $request->catatan,
            'bukti' => $bukti
        ]);
        return redirect()->back();

    }
    public function download ($memo_id)
    {
        $download = history_memo::where('id', $memo_id)->firstOrFail();
        $pathFile = storage_path('app\public/'. $download->bukti);

        return response()->download($pathFile);
    }
}

