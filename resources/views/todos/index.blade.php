<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
        }
        .table-dark {
            background-color: #222;
        }
        .completed {
            text-decoration: line-through;
            color: red;
        }
        .completed-task {
            order: 1; /* Ensure completed tasks appear at the bottom */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">To-Do App</h1>

        <!-- Add Task Form -->
        <form action="{{ route('todos.store') }}" method="POST" class="mb-3">
            @csrf
            <div class="input-group">
                <input type="text" name="title" class="form-control" placeholder="Add a new task" required>
                <button class="btn btn-primary" type="submit">Add</button>
            </div>
        </form>

        <!-- Task List -->
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Task</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="todo-table">
                @foreach ($todos as $todo)
                    <tr data-id="{{ $todo->id }}" class="{{ $todo->completed ? 'completed completed-task' : '' }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $todo->title }}</td>
                        <td>
                            <!-- Complete / Undo Button -->
                            <button class="btn btn-sm btn-success complete-btn" data-completed="{{ $todo->completed ? 'true' : 'false' }}">
                                {{ $todo->completed ? 'Undo' : 'Complete' }}
                            </button>

                            <!-- Edit Button -->
                            <a href="{{ route('todos.edit', $todo->id) }}" class="btn btn-sm btn-warning">Edit</a>

                            <!-- Delete Button -->
                            <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        // $(document).on('click', '.complete-btn', function () {
        //     const row = $(this).closest('tr');
        //     const todoId = row.data('id');
        //     const completed = $(this).data('completed') === 'true' ? 'false' : 'true';

        //     $.ajax({
        //         url: `/todos/${todoId}`,
        //         type: 'PUT',
        //         data: {
        //             _token: '{{ csrf_token() }}',
        //             completed: completed
        //         },
        //         success: function () {
        //             row.toggleClass('completed');
        //             row.toggleClass('completed-task');
        //             $(this).data('completed', completed);
        //             $(this).text(completed === 'true' ? 'Undo' : 'Complete');
        //         }
        //     });
        // });

        $(document).on('click', '.complete-btn', function () {
        const row = $(this).closest('tr');
        const todoId = row.data('id');
        const currentCompleted = $(this).data('completed') === 'true'; // Get current state (true/false)

        const newCompleted = !currentCompleted; // Toggle the completed state
        const completedText = newCompleted ? 'Undo' : 'Complete'; // Button text change

        $.ajax({
            url: `/todos/${todoId}`,
            type: 'PUT',
            data: {
                _token: '{{ csrf_token() }}',
                completed: newCompleted // Send the new state as a boolean
            },
            success: function () {
                // Toggle CSS classes based on the completed state
                row.toggleClass('completed', newCompleted);
                row.toggleClass('completed-task', newCompleted);
                $(this).data('completed', newCompleted); // Update the data attribute
                $(this).text(completedText); // Update button text

                // Reload the page to reflect changes
                location.reload();
            }.bind(this) // Preserve the context of `this`
        });
    });
    </script>
</body>
</html>
