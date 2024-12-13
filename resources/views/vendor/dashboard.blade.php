<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vendor</title>
</head>
<body>
    <h1>販売者ダッシュボード</h1>
    <p>ようこそ、{{ Auth::guard('vendor')->user()->name }} さん！</p>
    <form method="POST" action="{{ route('vendor.logout') }}">
        @csrf
        <button type="submit">ログアウト</button>
    </form>
</body>
</html>
