<!-- resources/views/todos/edit.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #121212; /* Dark background */
            color: #ffffff; /* White text */
        }
        .container {
            background-color: #222; /* Dark container background */
            padding: 20px;
            border-radius: 8px;
        }
        .form-label {
            color: #fff; /* White label text */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Task</h1>

        <!-- Edit Task Form -->
        <form action="{{ route('todos.updateTitle', $todo->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Task Title</label>
                <input type="text" name="title" class="form-control" value="{{ $todo->title }}" required>
            </div>

            <button type="submit" class="btn btn-success">Save Changes</button>
            <a href="{{ route('todos.index') }}" class="btn btn-danger">Cancel</a>
        </form>
    </div>
</body>
</html>
