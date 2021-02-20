$(document).ready(() => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#addTaskForm').submit((e) => {
        e.preventDefault();

        const taskText = $('#taskText');
        const todoId = $('#add-task').attr('data-todoId');
        const taskDueDate = $('#taskDueDate');

        $.ajax({
            type: 'POST',
            url: '/task',
            dataType: 'JSON',
            data: {
                'todo_list_id': todoId,
                'text': taskText.val(),
                'due': taskDueDate.val()
            },
            success(response) {
                if (response.created) {
                    const newTask = response.newTask;

                    const newTaskHTML = `<tr>
                                            <td>input</td>
                                            <td>${newTask.text}</td>
                                            <td>${newTask.due}</td>
                                        </tr>`;

                    $('#todoListBody').prepend(newTaskHTML);
                }
            },
            error(response) {
                console.log(response);
            }
        });
    });
});
