@extends('layouts.parent')

@section('title', 'DO-ONプレイ')

<!-- header -->
@section('header')
  @parent
@endsection

<!-- main -->
@section('main')
<div class="c_content-card">

  <div class="c_content-title u_ta-center">
    <p class="c_content-title-text">
      <i class="fa-solid fa-triangle-exclamation"></i>
      ご注意ください！
    </p>
  </div>

  <div class="u_margin">
    <p class="u_margin-bottom">退会すると</p>
    <p class="u_font-weight-bold">・ユーザー情報</p>
    <p class="u_margin-bottom u_font-weight-bold">・あなたが作成した問題集と問題のすべて</p>
    <p>が完全に削除されます。※復元できません。</p>
    <p class="u_margin-bottom">ご確認の上、処理を進めてください。</p>
  </div>
  <div class="">
      <form method="POST" action="{{ route('withdraw', $user_id) }}">
        @csrf

       <label for="prof_pass">パスワード：</label>
         <input type="password" name="password" class="form-control @error('password') valid-error @enderror" id="prof_pass" placeholder="パスワードを入力してください" autocomplete="off">
         <!-- error -->
         @error('password')
             <span class="invalid-feedback" role="alert" style="display:block;">
               <strong>{{ $message }}</strong>
             </span>
         @enderror
       </div>

       <div class="p_form-submit">
         <button type="submit" class="btn btn-primary" onclick='return confirm("退会（すべての情報を削除）しますか？");'>
            {{ __('退会する') }}
          </button>
        </div>

      </form>
  </div>

</div>
@endsection

<!-- footer -->
@section('footer')
  @parent
  <script src="{{ asset('js/app.js') }}" defer></script>
@endsection
