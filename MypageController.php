<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use App\Drill;
use App\Problem;
use App\Http\Requests\ValidRequest;


class MypageController extends Controller
{
        //mypageへ
        public function mypage(){
            //drillとproblem情報を取得して変数に
            $user = Auth::user();
            $user_id = Auth::id();
            $drills = DB::table('drills')->where('user_id', $user_id)->paginate(1);
            $problems = DB::table('problems')->where('user_id', $user_id)->get();
            //dd($problems);

            return view('mypage', compact('user', 'drills', 'problems'));
        }

        //同じ問題集の問題一覧ページへ
        public function problems_index($id){
            //一覧ページに表示する旨の処理を設定して、viewを作ってリダイレクトさせる
            $problems = DB::table('problems')->where('drills_id', $id)->paginate(1);
            return view('problem_index', compact('problems'));
        }

        //新規作成画面へ
        public function new(){
            return view('quiz/create');
        }

        //問題新規作成
        public function create(ValidRequest $request){
            //モデルを使用してDBに登録する値を取得
            $drill = new Drill;
            $problem = new Problem;
            $user_id = Auth::id();

            //drillsテーブルにはuser_id(誰が作ったか)とtitle(問題集名)を挿入
            //problemsテーブルには問題の詳細をそれぞれ挿入
            
            //drill_idの処理
            $db_drill = DB::table('drills');

            if($db_drill->where('user_id', $user_id)->where('title', $request->title)->count() === 0){
                //同じユーザーでかつ、同じタイトルの問題集がない場合は新規作成・保存
                $drill->fill(['title' => $request->title, 'user_id' => $user_id])->save();
                $drill_id = $drill->id;
                $drill_title = $request->title;

            }else{
                //既に同じタイトルのdrillsが存在する場合はそのIDとタイトルを取得するだけ
                $drill_id = $db_drill->where('user_id', $user_id)->where('title', $request->title)->value('id');
                $drill_title = $db_drill->where('user_id', $user_id)->where('title', $request->title)->value('title');
            }

            $problem->fill(
                [
                    'user_id'           => $user_id,
                    'drills_id'         => $drill_id,
                    'title'             => $drill_title,
                    'subtitle'          => $request->subtitle,
                    'problem_statement' => $request->problem_statement,
                    'correct'           => $request->correct,
                    'fake1'             => $request->fake1,
                    'fake2'             => $request->fake2,
                    'fake3'             => $request->fake3,
                    'comment'           => $request->comment,
                ])->save();

                //リダイレクト
                return redirect('/mypage')->with('flash_message', __('registered!'));

        }

        //編集画面へ
        public function edit($id){
            //パラメータが数字かチェック
            if(!ctype_digit($id)){
                return redirect('/welcome')->with('flash_message', __('Invalid operation was performed'));
              }

            $problems = DB::table('problems')->find($id);
            return view('quiz/edit', compact('problems'));
        }

        //編集(アップデート)
        public function update(ValidRequest $request, $id){
            //パラメータが数字かチェック
            if(!ctype_digit($id)){
                return redirect('/welcome')->with('flash_message', __('Invalid operation was performed'));
            }
            //drill（問題集の方）情報を取得
            $user_id = Auth::id();
            $db_drill = DB::table('drills');

            if($db_drill->where('user_id', $user_id)->where('title', $request->title)->count() === 0){
                //同じユーザーでかつ、同じタイトルの問題集がない場合は新規作成・保存
                $drill->fill(['title' => $request->title, 'user_id' => $user_id])->save();
                $drill_id = $drill->id;
                $drill_title = $request->title;

            }else{
                //既に同じタイトルのdrillsが存在する場合はそのIDとタイトルを取得するだけ
                $drill_id = $db_drill->where('user_id', $user_id)->where('title', $request->title)->value('id');
                $drill_title = $db_drill->where('user_id', $user_id)->where('title', $request->title)->value('title');
            }

            $problems = Problem::where('id',$id);
            //DBに更新して保存
            $problems->update([
                'drills_id'         => $drill_id,
                'title'             => $drill_title,
                'subtitle'          => $request->subtitle,
                'problem_statement' => $request->problem_statement,
                'correct'           => $request->correct,
                'fake1'             => $request->fake1,
                'fake2'             => $request->fake2,
                'fake3'             => $request->fake3,
                'comment'           => $request->comment,
            ]);
            dd('いけたかな');
        }

        //問題集削除
        public function drills_delete($id){
            //パラメータが数字かチェック
            if(!ctype_digit($id)){
                return redirect('/welcome')->with('flash_message', __('Invalid operation was performed'));
              }

            DB::table('drills')->where('id', $id)->delete();
            //drillの中に問題が設定されている場合は削除
            if(DB::table('problems')->where('drills_id', $id)->count() !== 0){
                DB::table('problems')->where('drills_id', $id)->delete();
            }
            
            //マイページにリダイレクト
            return redirect('/mypage')->with('flash_message', __('Deleted'));
        }

        //問題(各クイズ)
        public function problem_delete($id){

            //パラメータが数字かチェック
            if(!ctype_digit($id)){
                return redirect('/welcome')->with('flash_message', __('Invalid operation was performed'));
            }

            DB::table('problems')->where('id', $id)->delete();
            
            //マイページにリダイレクト
            return redirect('/mypage')->with('flash_message', __('Deleted'));

        }

}
