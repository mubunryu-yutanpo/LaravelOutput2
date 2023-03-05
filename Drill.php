<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drill extends Model
{
    //drillsテーブルのカラムに挿入するものをfillable(もしくは動かしたくないのをguardedで指定)
    protected $fillable = ['user_id', 'title'];

    //他のモデル（テーブル）との関係性
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function problem(){
        return $this->hasMany('App\Models\Problem');
    }
}
