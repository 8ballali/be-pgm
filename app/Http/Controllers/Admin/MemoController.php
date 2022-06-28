<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Meeting;
use App\Models\Memo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemoController extends Controller
{
    public function index()
    {

        $logged_in = Auth::id();
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

        return view('admin.memo', compact('name', 'memo', 'meeting', 'employee'));
    }
}
