@props(['profile'])
<div class="main">
    <x-main-title>プロフィールの編集</x-main-title>
    @error('name')
    <p style="color:red;">name</p>
    @enderror
    @error('gender')
        gender
    @enderror
    @error('address')
        address
    @enderror
    @error('yearsold')
        yo
    @enderror
    <form action="{{ route('manage.profile.store') }}" method="post">
        @csrf
        <label>ユーザ名<input type="text" name="name" class='form' value='{{ $profile['name'] }}'></label>
        <label>
            性別
            <select name="gender" class="form">
                <option value=''>未選択</option>
                <option value="男" @if ($profile['gender'] == '男') selected @endif>男</option>
                <option value="女" @if ($profile['gender'] == '女') selected @endif>女</option>
                <option value="その他" @if ($profile['gender'] == 'その他') selected @endif>その他</option>
            </select>
        </label>
        <label>住所(都道府県) <input type="text" name="address"></label>
        <label>年齢<input type="tel" name="yearsold"></label>
        <input type="submit">
    </form>
</div>
