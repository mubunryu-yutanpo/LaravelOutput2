<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    //drillsテーブルのカラムに挿入するものをfillable(もしくは動かしたくないのをguardedで指定)
    protected $fillable = ['title', 'subtitle', 'user_id', 'drills_id', 'problem_statement', 'correct', 'fake1', 'fake2', 'fake3', 'comment', 'image'];

    //他との関係性
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function drill(){
        return $this->belongsTo('App\Model\Drill');
    }
}
