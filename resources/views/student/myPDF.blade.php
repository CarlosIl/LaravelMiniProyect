<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Students PDF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div>

        <h1 class="text-primary mt-3 mb-4 text-center"><b>Students</b></h1>

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col col-md-6"><b>Student Data</b></div>
                </div>
            </div>
            <div class="card-body">
                @php($actions = false)
                @include('student.table')
            </div>
        </div>

    </div>
</body>

</html>
