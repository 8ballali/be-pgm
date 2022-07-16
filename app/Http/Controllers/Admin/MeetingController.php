<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use App\Models\Meeting;
use App\Models\Employee;

class MeetingController extends Controller
{
    public function index()
    {
        $meeting = Meeting::with('employee')->get();
        $employee = Employee::get();
        $department = Department::all();
        $logged_in = Auth::id();
        if (Auth::user()->role_id == 1) {
            $roles = Auth::user()->roles->name;
            $name = $roles;
        }else {
            $employee_name = Employee::where('user_id', $logged_in)->select('name')->get();
            $name = $employee_name[0]->name;
        }
        return view('admin.meeting', compact('meeting','employee','department', 'name'));

    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'tanggal' => 'required',
            'judul' => 'required',
            'notulensi' => 'required',
        ]);
        $logged_in = Auth::id();
        $employee_id = Employee::where('user_id', $logged_in)->select('id')->get();
        $id = $employee_id[0]->id;
        Meeting::create([
            'tanggal' => $request->tanggal,
            'judul' => $request->judul,
            'notulensi' => $request->notulensi,
            'employee_id' => $id,

        ]);
        toast('Your Notulensi as been submited!','success');
        return redirect('/meeting');
    }
    public function destroy ($id){
        $meeting = Meeting::findOrFail($id);
        $meeting->delete();
        return redirect('/meeting');
    }
    public function update(Request $request, $id){
        $meeting = Meeting::find($id);
        $meeting->tanggal = $request->input('tanggal');
        $meeting->judul = $request->input('judul');
        $meeting->notulensi = $request->input('notulensi');
        $meeting->save();
        toast('Meeting Updated!','success');
        return redirect('/meeting');
    }

}
