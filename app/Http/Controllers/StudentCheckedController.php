<?php

namespace App\Http\Controllers;

use App\DataTables\CheckDayDataTable;
use App\Models\CheckDay;
use App\Models\Checked;
use App\Models\ClassCourse;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentCheckedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = ClassCourse::query()
            ->where('teacherId', Auth::user()->id)
            ->pluck('name', 'courseId');
        return view('pages.checked.index', compact(['classes']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $checkdays = CheckDay::query()
            ->where('classId', $request->classId)
            ->whereDate('created_at', Carbon::today())
            ->where('check', 1)
            ->get();
        $student = [];
        foreach ($checkdays as $checkday) {
            if (in_array($checkday->masv, $student) != true) {
                $checked = Checked::query()
                    ->where('studentId', $checkday->student->id)
                    ->where('courseId', $checkday->classe->id)->first();
                $days = $checked->days + 1;
                $checked->update([
                    'days' => $days
                ]);
                array_push($student, $checkday->masv);
            }
        }
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function checkday(Request $request)
    {
        $data = $request->data;
        foreach ($data as $studentck) {
            if ($studentck[0] != 'unknown' && $studentck[0] <= 21) {
                $student = Student::query()->where('masv', $studentck[0])->first();
                $classes = $student->course;
                $studentInClass = [];
                foreach ($classes as $class) {
                    array_push($studentInClass, $class->courseId);
                }
                $masv = $student->masv;
                $name = $student->name;
                if (in_array($request->classId, $studentInClass) == true) {
                    $check = 1;
                } else {
                    $check = 0;
                }
            } else {
                $masv = 0;
                $name = 'unknown';
                $check = 0;
            }
            CheckDay::create([
                'masv' => $masv,
                'name' => $name,
                'imageLink' => "http://localhost:5000" . $studentck[1],
                'classId' => $request->classId,
                'teacherId' => $request->teacherId,
                'check' => $check
            ]);
        }
        return response()->json(['success' => 'successfully']);
    }

    public function checked(Request $request)
    {
        return redirect()->route('checkday.checkedInfor', $request->classId);
    }

    public function checkedInfor($classId, CheckDayDataTable $table)
    {
        $class = ClassCourse::query()->where('courseId', $classId)->first();
        $table->classId = $classId;
        return $table->render('pages.checked.checkday', compact('class'));
    }
}
