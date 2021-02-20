@foreach($todoTasks as $todoTask)
    <tr>
        <td>input</td>
        <td>{{ $todoTask->text }}</td>
        <td>{{ $todoTask->due }}</td>
    </tr>
@endforeach
