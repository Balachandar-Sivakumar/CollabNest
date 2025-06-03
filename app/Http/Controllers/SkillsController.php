<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use Illuminate\Http\Request;
use App\Models\Skills;


class SkillsController extends Controller
{
    public function getProfession(Request $request){
    $query = $request->get('q');

     if (!$query) return response()->json([]);

    return Profession::where('profession', 'like', '%' . $query . '%')->pluck('profession');
    }
}
