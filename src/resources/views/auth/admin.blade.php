@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')


@section('header')
<form action="/logout" method="post">
    @csrf
    <button class="header__logout-btn">logout</button>
    </form>
@endsection('header')

@section('content')
    <h2 class="page-title">Admin</h2>
    <form action="/search" method="get" class="search-form">
        <input type="text" name="keyword" class="search-input" placeholder="名前やメールアドレスを入力してください">
        <select name="gender" class="search-select">
            <option value="">性別</option>
            <option value="1">男性</option>
            <option value="2">女性</option>
            <option value="3">その他</option>
        </select>
        <select name="category_id" class="search-select">
            <option value="">お問い合わせの種類</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->content }}</option>
            @endforeach
        </select>

        <input type="date" name="date" class="search-date">

        <button type="submit" class="search-submit">検索</button>
        <a href="/reset" class="search-reset">リセット</a>
    </form>

    <div class="table-utility">
        <button class="export-btn">エクスポート</button>
        <div class="pagination">
            {{ $contacts->links('vendor.pagination.custom') }}
        </div>
    </div>
    <table class="admin-table">
        <thead>
            <tr>
                <th>お名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせの種類</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
            <tr>
                <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                <td>{{ $contact->gender_label }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->category->content }}</td>
                <td>
                    <button class="detail-btn"
                    data-id="{{ $contact->id }}"
                    data-name="{{ $contact->last_name }} {{ $contact->first_name }}"
                    data-gender="{{ $contact->gender_label }}"
                    data-email="{{ $contact->email }}"
                    data-tel="{{ $contact->tel }}"
                    data-address="{{ $contact->address }}"
                    data-building="{{ $contact->building }}"
                    data-category="{{ $contact->category->content }}"
                    data-detail="{{ $contact->detail }}">
                    詳細
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
<div class="modal" id="detail-modal">
    <div class="modal__inner">
        <button class="modal__close-btn" id="modal-close">×</button>
        <div class="modal__content">
            <table class="modal-table">
                <tr><th>お名前</th><td id="modal-name"></td></tr>
                <tr><th>性別</th><td id="modal-gender"></td></tr>
                <tr><th>メールアドレス</th><td id="modal-email"></td></tr>
                <tr><th>電話番号</th><td id="modal-tel"></td></tr>
                <tr><th>住所</th><td id="modal-address"></td></tr>
                <tr><th>建物名</th><td id="modal-building"></td></tr>
                <tr><th>お問い合わせの種類</th><td id="modal-category"></td></tr>
                <tr><th>お問い合わせ内容</th><td id="modal-detail"></td></tr>
            </table>
            <form action="/delete" method="post" class="modal__delete-form">
                @csrf
                <input type="hidden" name="id" id="delete-id">
                <button type="submit" class="modal__delete-btn" onclick="return confirm('本当に削除しますか？')">削除</button>
            </form>
        </div>
    </div>
</div>
<div class="modal-overlay" id="modal-overlay"></div>
@endsection('content')