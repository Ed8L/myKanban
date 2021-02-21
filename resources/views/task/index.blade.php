@include('task.components.edit_task-modal')
@foreach($todoTasks as $todoTask)
    <tr class="task" data-taskId="{{ $todoTask->id }}">
        <td>{{ $todoTask->completed }}</td>
        <td>{{ $todoTask->text }}</td>
        <td>{{ $todoTask->due }}</td>
    </tr>
@endforeach
