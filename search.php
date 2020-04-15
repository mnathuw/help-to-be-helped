<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Help to be helped tasks</title>
  </head>
  <body>
        <form>
            <div class="form-group">
                <label  class="font-weight-bold" for="task">Search for available tasks</label>
                <input type="text" class="form-control" id="task" placeholder="Counselling" autofocus>
            </div>
            <div class="field"> 
                <p class="help">
                    Try searching for <a class="query" href="#counselling">Counselling</a> or 
                    <a class="query" href="#haircuts">Haircuts and Care</a>.
                </p> 
            </div>
            <button type="submit" class="btn btn-primary" id="queryDistrict">Search</button>
        </form>
        <br>
        <p id="result" class="mb-0 d-none font-weight-bold"></p>
        <br>
        <table class="table d-none" id='tblData'>
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Desciption</th>
                    <th scope="col">Date Posted</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <p id="notice" class="mb-0 d-none font-weight-bold"></p>
    </div>
    <script src="main.js?1"></script>
  </body>
</html>