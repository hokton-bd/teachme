<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = [
            ['subject_name' => '国語'],
            ['subject_name' => '数学'],
            ['subject_name' => '日本史'],
            ['subject_name' => '世界史'],
            ['subject_name' => '英語'],
            ['subject_name' => '物理'],
            ['subject_name' => '化学'],
            ['subject_name' => '生物'],
            ['subject_name' => 'プログラミング']

        ];

        foreach($subjects as $subject) {

            \App\Models\Subject::create($subject);

        }

    }
}
