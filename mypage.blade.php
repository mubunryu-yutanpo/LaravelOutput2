@extends('layouts.parent')

@section('title', 'DO-ONマイページ')

@section('header')

@section('main')

  <div class="c_main_top-container">
    <h4 class="c_main_top-title">マイページ</h4>
    <p class="c_main_top-name">{{ $user->name }} さん</p>
  </div>

  <div class="c_content-title">
    <p class="c_content-title-text">
      <i class="fa-solid fa-book"></i>
      作成した問題集
    </p>
  </div>

  <div class="c_content-container">
    <!-- for文で作った問題集を表示する -->
    @foreach($drills as $drill)
    <div class="c_content-card">
        <!-- title -->
        <p class="c_content-card-title bg-1">{{ $drill->title }}</p>
        <div class="c_content-card-wrap">
            <a href="{{ route('play', $drill->id) }}" class="c_content-card-link">プレイ</a>
            <a href="{{ route('problems_index', $drill->id) }}" class="c_content-card-link">編集</a>
            <!--削除-->
             <form action="{{ route('drills.delete', $drill->id) }}" method="POST" class="d-inline">
               @csrf
               <button class="c_content-card-link" onclick='return confirm("この問題集を削除しますか？");'>
                 {{ __('Go Delete') }}
              </button>
             </form>
        </div>
    </div>
    @endforeach
  </div>


  <!-- ページネーション -->
  <div class="pagination">
    {{ $drills->links() }}
   </div>

@endsection


@section('footer')
