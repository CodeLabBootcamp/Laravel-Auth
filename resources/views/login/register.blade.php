<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <br><br><br>
    @if($errors->count() >0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </div>
    @endif
    <form method="post" action="{{Route('auth.register',['_token'=>csrf_token()])}}">
        <div class="form-group">
            <label for="exampleInputPassword1">Name</label>
            <input name="name" value="{{old('name')}}" type="text" class="form-control" id="exampleInputPassword1" placeholder="name">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input name="email" type="email" value="{{old('email')}}" class="form-control" id="exampleInputEmail1"
                   placeholder="Email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input name="password"type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Re-Password</label>
            <input name="re_password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Re-Password">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
</div>


<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
</body>
</html>

