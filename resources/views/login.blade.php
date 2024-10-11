<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    >
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
</head>
<body>
    <div class="card" style="width:500px;margin:200px auto">
        <div class="card-header">
            <h1>Login</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('authenticate') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label><br/>
                    <input type="email" class="form-control" name="email" id="email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label><br/>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                @if($errors->any())
                    <div class="alert alert-danger mt-2">
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                <button type="submit" class="btn btn-primary mt-2">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
