<?php

namespace App\Http\Controllers;

use App\DataTables\ListStudentDataTable;
use App\Models\ClassCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ListStudentDataTable $table
     * @return \Illuminate\Http\Response
     */
    public function index(ListStudentDataTable $table)
    {
        if (Auth::user()->hasRole('Administrators')) {
            $classes = ClassCourse::query()
                ->pluck("name", "id");
        } elseif (Auth::user()->hasRole('Teachers')) {
            $classes = ClassCourse::query()
                ->where('teacherId', Auth::user()->id)
                ->pluck("name", "id");
        }
        $table->courseId = 0;
        return $table->render('pages.students.classselect', compact('classes'));
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
        //
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

    public function student(Request $request)
    {
        return redirect()->route('class.studentlist', $request->class_number);
    }

    public function classStudent($classId, ListStudentDataTable $table)
    {
        if (Auth::user()->hasRole('Administrators')) {
            $classes = ClassCourse::query()
                ->pluck("name", "id");
        } elseif (Auth::user()->hasRole('Teachers')) {
            $classes = ClassCourse::query()
                ->where('teacherId', Auth::user()->id)
                ->pluck("name", "id");
        }
        $table->courseId = $classId;
        return $table->render('pages.students.classselect', compact(['classes', 'classId']));
    }
}
