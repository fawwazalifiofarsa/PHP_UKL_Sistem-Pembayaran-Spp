<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <title>Log In</title>
</head>
<body>
  <div class="row" style="margin-top:130px;">
      <div class="col-md-2" style="padding: 30px; margin: auto;">
        <form action="proses_login.php" method="post">
        <h1 align="center">Log In</h1>
          <div class="form">
            Username
            <input type="text" name="username" class="form-control" style="margin-bottom: 12px;">
            Password
            <input type="password" name="password" class="form-control" style="margin-bottom: 21px;">
            <div class="submit">
              <input type="submit" name="login" class="button" value="Log In"><br>
            </div>
          </div>
        </form>
        <div class="account">
        Log In Sebagai Siswa <a href="login_siswa.php">Click Disini</a>
        </div>
      </div>
  </div>
</body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</html>
