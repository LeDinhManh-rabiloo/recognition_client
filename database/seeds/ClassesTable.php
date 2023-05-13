<?php

use Illuminate\Database\Seeder;
use App\Models\ClassCourse;

class ClassesTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'courseId' => 123456,
                'name' => 'Lập trình java',
                'teacherId' => 2
            ],
            [
                'courseId' => 123457,
                'name' => 'Mô hình hóa',
                'teacherId' => 2
            ],
            [
                'courseId' => 123458,
                'name' => 'Mã nguồn mở',
                'teacherId' => 2
            ]
        ];
        foreach ($data as $class) {
            $classc = ClassCourse::create($class);
        }
    }
}
