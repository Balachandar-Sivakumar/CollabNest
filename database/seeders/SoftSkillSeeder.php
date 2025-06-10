<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SoftSkill;

class SoftSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $softSkills = ['Communication','Teamwork','Problem Solving','Adaptability','Time Management','Creativity','Critical Thinking','Emotional Intelligence','Leadership','Work Ethic','Conflict Resolution','Decision Making','Collaboration','Responsibility','Attention to Detail','Stress Management','Active Listening','Negotiation','Empathy','Flexibility','Self-Motivation','Patience','Public Speaking','Organization','Confidence','Interpersonal Skills','Accountability','Cultural Awareness','Growth Mindset','Positive Attitude'];
        foreach ($softSkills as $skill) {
            SoftSkill::create([
                'soft_skills' => $skill
                ]);
            }
    }
}
