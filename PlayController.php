<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use App\Drill;
use App\Problem;
use App\Http\Requests\ValidRequest;

class PlayController extends Controller
{
    //play画面へ(その問題集のIDを取ってくる)
    public function play($id){
        //idが同じ問題集の問題を全取得
        $problems = DB::table('problems')->where('drills_id', $id)->get();

        return view('quiz/play', compact('problems'));
    }

}
