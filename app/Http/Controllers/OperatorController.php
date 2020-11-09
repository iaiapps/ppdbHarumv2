<?php

namespace App\Http\Controllers;

use App\Models\Setup\Uniform;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Students\Fund_category;

class OperatorController extends Controller
{
    public function showStudents()
    {
        $students=Student::latest()->paginate(15);

        return view('op.students',compact('students'));
    }
    public function confirmPage()
    {
        $students = Student::where('status',1)->paginate(30);
        return view('op.confirmPage',compact('students')); 
    }
    public function fundCategories()
    {
        $funds = Fund_category::latest()->get();
        return view('op.fund_categories',compact('funds'));
    }
    public function confirmAcc(Request $request)
    {
        Student::whereIn('id',$request->status)->update(['status'=>2]);
        return back();
    }
    public function confirmReject(Request $request)
    {
        Student::whereIn('id',$request->status)->update(['status'=>3]);
        return back();
    }
    public function confirmed()
    {
        $students = Student::where('status','!=',1)->orderBy('status','asc')->paginate(15);
        return view('op.confirmed',compact('students'));
    }
    public function uniformTable()
    {
        $uniforms=Uniform::get();
        return view('op.uniformTable',compact('uniforms'));
    }
    public function opSet()
    {
        return view('op.opset');
    }
}
