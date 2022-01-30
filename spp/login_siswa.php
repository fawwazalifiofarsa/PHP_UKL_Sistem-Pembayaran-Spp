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
        <form action="proses_login_siswa.php" method="post">
        <h1 align="center">Log In Siswa</h1>
          <div class="form">
            NISN
            <input type="text" name="nisn" class="form-control" style="margin-bottom: 12px;">
            <div class="submit">
              <input type="submit" name="login" class="button" value="Log In"><br>
            </div>
          </div>
        </form>
      </div>
  </div>
</body>
</html>