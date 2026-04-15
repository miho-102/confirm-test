@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('header')
<a href="/register" class="register-btn">register</a>
@endsection('header')

@section('content')
<h2 class="page-title">Login</h2>
    <form action="/login" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="例: test@example.com">
            @error('email')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" placeholder="例: coachtech1106">
            @error('password')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-footer">
            <button type="submit" class="btn">ログイン</button>
        </div>
    </form>
@endsection