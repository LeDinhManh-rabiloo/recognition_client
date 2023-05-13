<?php

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentTable extends Seeder
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
                'masv' => 2,
                'name' => 'Lê Đình Mạnh',
                'className' => 'KTPM_2_K11'
            ],
            [
                'masv' => 3,
                'name' => 'Dương Trọng Nghĩa',
                'className' => 'KTPM_2_K11'
            ],
            [
                'masv' => 4,
                'name' => 'Trần Bá Linh',
                'className' => 'KTPM_2_K11'
            ],
            [
                'masv' => 5,
                'name' => 'Đoàn Văn Quân',
                'className' => 'KTPM_2_K11'
            ],
            [
                'masv' => 6,
                'name' => 'Phạm Quang Thiện',
                'className' => 'KTPM_2_K11'
            ],
            [
                'masv' => 7,
                'name' => 'Vũ Thị Hồng Nguyệt',
                'className' => 'KTPM_2_K11'
            ],
            [
                'masv' => 8,
                'name' => 'Trịnh Văn Bắc',
                'className' => 'KTPM_2_K13'
            ],
            [
                'masv' => 9,
                'name' => 'Phạm Quốc Huy',
                'className' => 'KTPM_2_K11'
            ],
            [
                'masv' => 10,
                'name' => 'Lê Xuân Mười',
                'className' => 'KTPM_2_K11'
            ],
            [
                'masv' => 11,
                'name' => 'Nguyễn Thị Thơm',
                'className' => 'KTPM_2_K11'
            ],
            [
                'masv' => 12,
                'name' => 'Trần Thị Ngọc Ánh',
                'className' => 'KHMT_1_K12'
            ],
            [
                'masv' => 13,
                'name' => 'Nguyễn Thị Huế',
                'className' => 'KTPM_2_K11'
            ],
            [
                'masv' => 14,
                'name' => 'Nguyễn Văn Lương',
                'className' => 'HTTT_1_K11'
            ],
            [
                'masv' => 15,
                'name' => 'Lê Thanh Thủy',
                'className' => 'KTPM_2_K11'
            ],
            [
                'masv' => 16,
                'name' => 'Nguyễn Văn Phong',
                'className' => 'KTPM_2_K11'
            ],
            [
                'masv' => 17,
                'name' => 'Đặng Tuấn Đạt',
                'className' => 'KTPM_2_K11'
            ],
            [
                'masv' => 18,
                'name' => 'Nguyễn Toàn Văn',
                'className' => 'KTPM_2_K12'
            ],
            [
                'masv' => 19,
                'name' => 'Nguyễn Thị Hường',
                'className' => 'KTPM_2_K11'
            ],
            [
                'masv' => 20,
                'name' => 'Đặng Trần Hoàn',
                'className' => 'KTD_3_K12'
            ],
            [
                'masv' => 21,
                'name' => 'Đỗ Đức Lợi',
                'className' => 'KTPM_2_K11'
            ],
        ];
        foreach ($data as $student) {
            Student::create($student);
        }
    }
}
