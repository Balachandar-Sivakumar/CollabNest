<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profession;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $professions = ['Software Engineer','Web Developer','Mobile Developer','DevOps Engineer','Data Scientist','AI Engineer','Machine Learning Engineer','Cloud Architect','Cybersecurity Analyst','UI/UX Designer','Frontend Developer','Backend Developer','Full Stack Developer','Database Administrator','Network Engineer','System Administrator','Game Developer','Embedded Systems Engineer','Blockchain Developer','Product Manager','Project Manager','Scrum Master','QA Engineer','Technical Writer','Solutions Architect','IT Support Specialist','AR/VR Developer','Data Analyst','Site Reliability Engineer','Tech Consultant'];

        foreach($professions as $profession){
            Profession::create([
                'profession' => $profession
            ]);
        }
    }
}
