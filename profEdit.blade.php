@extends('layouts.parent')

@section('title', 'プロフィール編集')

@section('header')

@section('main')

  <div class="c_main_top-container">
    <h4 class="c_main_top-title">プロフィール編集画面</h4>
  </div>

  <div class="p_form-container">
      <form method="POST" action="{{ route('prof_edit', $user->id) }}">
        @csrf

        <div class="form-group">
         
          <label for="prof_name">アカウント名：</label>
          <input type="text" name="name" class="form-control @error('name') valid-error @enderror" id="prof_name" value="{{ $user->name }}">
          <!-- error -->
          @error('name')
              <span class="invalid-feedback" role="alert" style="display:block;">
                <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>

        <div class="form-group">
         
         <label for="prof_email">E-mail：</label>
         <input type="email" name="email" class="form-control @error('email') valid-error @enderror" id="prof_email" value="{{ $user->email }}" autocomplete="email">
         <!-- error -->
         @error('email')
             <span class="invalid-feedback" role="alert" style="display:block;">
               <strong>{{ $message }}</strong>
             </span>
         @enderror
       </div>

       <label for="prof_pass">パスワード：</label>
         <input type="password" name="password" class="form-control @error('password') valid-error @enderror" id="prof_pass" value="" placeholder="※半角英数字8文字以上" autocomplete="off">
         <!-- error -->
         @error('password')
             <span class="invalid-feedback" role="alert" style="display:block;">
               <strong>{{ $message }}</strong>
             </span>
         @enderror

         <div class="p_form-submit">
           <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
         </div>

        </div>
      </form>

      <div class="c_main-another">
        <a href="{{ route('toWithdraw') }}" class="c_main-another-link">退会はこちら</a>
      </div>
  </div>


@endsection

@section('footer')
