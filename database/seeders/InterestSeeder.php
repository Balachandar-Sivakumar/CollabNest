<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Interests;

class InterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $interests = ['Artificial Intelligence','Machine Learning','Blockchain','Cybersecurity','Data Science','Cloud Computing','Web Development','Mobile Development','Game Development','Augmented Reality','Virtual Reality','Internet of Things','DevOps','Open Source','Quantum Computing','UI/UX Design','Software Engineering','3D Printing','Big Data','Database Systems','Operating Systems','Network Security','Ethical Hacking','Automation','Embedded Systems','Edge Computing','Natural Language Processing','Computer Vision','Tech Startups','Digital Privacy'];

        foreach($interests as $interest){
            Interests::create([
                'interest'=>$interest
            ]);
        }
    }
}
