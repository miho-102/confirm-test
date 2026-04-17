@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
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

<div class="search-section">
    <form action="/admin" method="get" class="search-form">
        <input type="text" name="keyword" class="input-keyword" value="{{ request('keyword') }}" placeholder="名前やメールアドレスを入力してください">
        <select name="gender" class="select-gender">
            <option value="">性別</option>
            <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
            <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
            <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
        </select>
        <select name="category_id" class="select-category">
            <option value="">お問い合わせの種類</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->content }}
            </option>
            @endforeach
        </select>

        <input type="date" name="date" class="input-date" value="{{ request('date') }}">

        <div class="form-actions">
            <button type="submit" class="search-btn">検索</button>
            <a href="/admin" class="reset-btn">リセット</a>
        </div>
    </form>
</div>

    <div class="table-utility">
        <a href="{{ url('/admin/export') }}?{{ http_build_query(request()->query()) }}" class="export-btn">
            エクスポート
        </a>
        <div class="pagination">
            {{ $contacts->links() }}
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
                <td>{{ $contact->category->content ?? '種類不明' }}</td>
                <td>
                    <a href="{{ request()->fullUrlWithQuery(['id' => $contact->id]) }}" class="detail-btn">
                        詳細
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
<div class="modal {{ $detail ? 'is-show' : '' }}">
    <div class="modal__inner">
        <a href="{{ request()->fullUrlWithQuery(['id' => null]) }}" class="modal__close-btn">×</a>

        @if($detail)
        <div class="modal__content">
            <table class="modal-table">
                <tr><th>お名前</th><td>{{ $detail->last_name }} {{ $detail->first_name }}</td></tr>
                <tr><th>性別</th><td>{{ $detail->gender_label }}</td></tr>
                <tr><th>メールアドレス</th><td>{{ $detail->email }}</td></tr>
                <tr><th>電話番号</th><td>{{ $detail->tel }}</td></tr>
                <tr><th>住所</th><td>{{ $detail->address }}</td></tr>
                <tr><th>建物名</th><td>{{ $detail->building }}</td></tr>
                <tr><th>お問い合わせの種類</th><td>{{ $detail->category->content ?? '' }}</td></tr>
                <tr><th>お問い合わせ内容</th><td>{!! nl2br(e($detail->detail)) !!}</td></tr>
            </table>
            <form action="/delete" method="post" class="modal__delete-form">
                @csrf
                <input type="hidden" name="id" value="{{ $detail->id }}">
                <button type="submit" class="modal__delete-btn" onclick="return confirm('本当に削除しますか？')">削除</button>
            </form>
        </div>
        @endif
    </div>
</div>
<div class="modal-overlay {{ $detail ? 'is-show' : '' }}" id="modal-overlay"></div>
@endsection('content')