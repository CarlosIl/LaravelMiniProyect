<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/ftp" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputFile">File input</label>
            <input type="file" name="profile_image" id="exampleInputFile" multiple />
        </div>
        {{ csrf_field() }}
        <button type="submit" class="btn btn-default">Submit</button>
    </form>    
</body>
</html>