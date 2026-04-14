@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="contact-form__content">
    <div class="contact-form__heading">
        <h2>Contact</h2>
    </div>
    <form class="form" action="/confirm" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お名前</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="last__name" value="{{ old('last__name') }}" placeholder="例 山田" />
                    <input type="text" name="first__name" value="{{ old('first__name') }}" placeholder="例 太郎" />
                </div>
                    @error('last__name')
                    <p style="color: red; margin: 0;">{{ $message }}</p>
                    @enderror
                    @error('first__name')
                    <p style="color: red; margin: 0;">{{ $message }}</p>
                    @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">性別</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="gender">
                    <label><input type="radio" name="gender" value="1" {{ old('gender') == '1' ? 'checked' : '' }}>男性</label>
                    <label><input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}>女性</label>
                    <label><input type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}>その他</label>
                </div>
                    @error('gender')
                    <p style="color: red; margin: 0;">{{ $message }}</p>
                    @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="例 test@example.com" />
                </div>
                    @error('email')
                    <p style="color: red; margin: 0;">{{ $message }}</p>
                    @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">電話番号</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="tel" name="tel1" value="{{ old('tel1') }}" placeholder="080" maxlength="3"/>
                    <span class="hyphen">-</span>
                    <input type="tel" name="tel2" value="{{ old('tel2') }}" placeholder="1234" maxlength="4" />
                    <span class="hyphen">-</span>
                    <input type="tel" name="tel3" value="{{ old('tel3') }}" placeholder="5678" maxlength="4"/>
                </div>
                @if($errors->has('tel1') || $errors->has('tel2') || $errors->has('tel3'))
                <p style="color: red;">
                    {{ $errors->first('tel1') ?: ($errors->first('tel2') ?: $errors->first('tel3')) }}
                </p>
                @endif
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="address" value="{{ old('address') }}" placeholder="例 東京都渋谷区千駄ヶ谷1-2-3" />
                </div>
                    @error('address')
                    <p style="color: red; margin: 0;">{{ $message }}</p>
                    @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <div class="form__label--item">建物名</div>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="building" placeholder="例 千駄ヶ谷マンション101" />
                </div>
                    @error('building')
                    <p style="color: red; margin: 0;">{{ $message }}</p>
                    @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせの種類</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--select">
                        <select name="category_id">
                            <option value="" disabled {{ old('category_id') === null ? 'selected' : '' }}>選択してください</option>
                            <option value="1" {{ old('category_id') == '1' ? 'selected' : '' }}>商品のお届けについて</option>
                            <option value="2" {{ old('category_id') == '2' ? 'selected' : '' }}>商品の交換について</option>
                            <option value="3" {{ old('category_id') == '3' ? 'selected' : '' }}>商品トラブル</option>
                            <option value="4" {{ old('category_id') == '4' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
                            <option value="5" {{ old('category_id') == '5' ? 'selected' : '' }}>その他</option>
                        </select>
                </div>
                @error('category_id')
                <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせの内容</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--textarea">
                    <textarea name="content" placeholder="お問い合わせ内容をご記載ください">{{ old('content') }}</textarea>
                </div>
                @error('content')
                <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面</button>
        </div>
    </form>
</div>
@endsection
