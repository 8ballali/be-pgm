<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use App\Models\history_memo;
use App\Models\Meeting;
use App\Models\Memo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function update(Request $request, $memo_id)
    {
        $history = history_memo::find($memo_id);
        $this->validate($request, [
            'name' => 'required',
        ]);

        Department::create([
            'name' => $request->name,
        ]);
        return redirect('/department');

    }
}

