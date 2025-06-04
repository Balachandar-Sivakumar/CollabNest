<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use Illuminate\Http\Request;
use App\Models\Skills;
use App\Models\Interests;
use App\Models\SoftSkills;

class SkillsController extends Controller
{
    public function getProfession(Request $request){
    $query = $request->get('q');

     if (!$query) return response()->json([]);

    return Profession::where('profession', 'like', '%' . $query . '%')->pluck('profession');
    }

    public function getSkills(Request $request){
        $query = $request->get('q');

        return Skills::where('skill','like','%'.$query.'%')->pluck('skill');
    }

    public function getInterests(Request $request){
        $query = $request->get('q');

        return Interests::where('interest','like','%'.$query.'%')->pluck('interest');
    }

     public function getSoftskills(Request $request){
        $query = $request->get('q');

        return SoftSkills::where('soft_skills','like','%'.$query.'%')->pluck('soft_skills');
    }
}
