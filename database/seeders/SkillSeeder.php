<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Skill;
use GuzzleHttp\Promise\Create;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $skills = ['PHP','Laravel','JavaScript','TypeScript','Python','Django','Flask','Node.js','Express.js','Vue.js','React','Angular','HTML','CSS','Tailwind CSS','Bootstrap','MySQL','PostgreSQL','MongoDB','SQLite','Redis','Git','GitHub','Bitbucket','Docker','Kubernetes','AWS','Azure','Google Cloud Platform','Firebase','REST APIs','GraphQL','Jest','Mocha','Cypress','Selenium','CI/CD','Linux','Bash','Nginx','Apache','Webpack','Vite','SASS','Less','Figma','Postman','Swagger','JIRA','Agile','Scrum'];
        for($i=0;$i<count($skills);$i++){
            Skill::Create([
                'skill'=>ucfirst($skills[$i])
            ]);
        }
    }
}
