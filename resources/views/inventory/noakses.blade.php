<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>No Access</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="text-center">
        <div class="alert alert-warning" role="alert">
            <h4 class="alert-heading">Access Denied</h4>
            <p>You do not have permission to access this page.</p>
        </div>
        <a href="{{ url()->previous() }}" class="btn btn-primary">Go Back</a>
    </div>
</body>
</html>
