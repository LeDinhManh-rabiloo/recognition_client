<?php

use Illuminate\Database\Seeder;
use App\Models\Checked;

class CheckedSedTable extends Seeder
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
                'studentId' => 1,
                'courseId' => 1,
                'days' => 0
            ],
            [
                'studentId' => 2,
                'courseId' => 1,
                'days' => 0
            ],[
                'studentId' => 3,
                'courseId' => 1,
                'days' => 0
            ],[
                'studentId' => 4,
                'courseId' => 1,
                'days' => 0
            ],[
                'studentId' => 5,
                'courseId' => 1,
                'days' => 0
            ],[
                'studentId' => 6,
                'courseId' => 1,
                'days' => 0
            ],[
                'studentId' => 7,
                'courseId' => 1,
                'days' => 0
            ],[
                'studentId' => 8,
                'courseId' => 1,
                'days' => 0
            ],
            [
                'studentId' => 9,
                'courseId' => 1,
                'days' => 0
            ],[
                'studentId' => 10,
                'courseId' => 1,
                'days' => 0
            ],[
                'studentId' => 11,
                'courseId' => 1,
                'days' => 0
            ],[
                'studentId' => 12,
                'courseId' => 1,
                'days' => 0
            ],[
                'studentId' => 13,
                'courseId' => 1,
                'days' => 0
            ],[
                'studentId' => 14,
                'courseId' => 1,
                'days' => 0
            ],[
                'studentId' => 1,
                'courseId' => 2,
                'days' => 0
            ], [
                'studentId' => 2,
                'courseId' => 2,
                'days' => 0
            ],[
                'studentId' => 3,
                'courseId' => 2,
                'days' => 0
            ],[
                'studentId' => 4,
                'courseId' => 2,
                'days' => 0
            ],[
                'studentId' => 5,
                'courseId' => 2,
                'days' => 0
            ],[
                'studentId' => 6,
                'courseId' => 2,
                'days' => 0
            ],[
                'studentId' => 7,
                'courseId' => 2,
                'days' => 0
            ],[
                'studentId' => 8,
                'courseId' => 2,
                'days' => 0
            ],
            [
                'studentId' => 9,
                'courseId' => 2,
                'days' => 0
            ],[
                'studentId' => 10,
                'courseId' => 2,
                'days' => 0
            ],[
                'studentId' => 11,
                'courseId' => 2,
                'days' => 0
            ],[
                'studentId' => 12,
                'courseId' => 2,
                'days' => 0
            ],[
                'studentId' => 13,
                'courseId' => 2,
                'days' => 0
            ],[
                'studentId' => 14,
                'courseId' => 2,
                'days' => 0
            ],[
                'studentId' => 1,
                'courseId' => 3,
                'days' => 0
            ], [
                'studentId' => 2,
                'courseId' => 3,
                'days' => 0
            ],[
                'studentId' => 3,
                'courseId' => 3,
                'days' => 0
            ],[
                'studentId' => 4,
                'courseId' => 3,
                'days' => 0
            ],[
                'studentId' => 5,
                'courseId' => 3,
                'days' => 0
            ],[
                'studentId' => 6,
                'courseId' => 3,
                'days' => 0
            ],[
                'studentId' => 7,
                'courseId' => 3,
                'days' => 0
            ],[
                'studentId' => 8,
                'courseId' => 3,
                'days' => 0
            ],
            [
                'studentId' => 9,
                'courseId' => 3,
                'days' => 0
            ],[
                'studentId' => 14,
                'courseId' => 3,
                'days' => 0
            ],[
                'studentId' => 15,
                'courseId' => 3,
                'days' => 0
            ],[
                'studentId' => 16,
                'courseId' => 3,
                'days' => 0
            ],[
                'studentId' => 17,
                'courseId' => 3,
                'days' => 0
            ],[
                'studentId' => 18,
                'courseId' => 3,
                'days' => 0
            ],
        ];
        foreach ($data as $check) {
            Checked::create($check);
        }
    }
}
