@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('header')
<a href="/login" class="login-btn">login</a>
@endsection('header')

@section('content')
    <h2 class="page-title">Register</h2>
    <form action="/register" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">お名前</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="例: 山田 太郎">
            @error('name')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
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
            <button type="submit" class="btn">登録</button>
        </div>
    </form>
@endsection