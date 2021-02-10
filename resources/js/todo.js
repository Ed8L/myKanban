$('[data-toggle="popover"]').popover();

function changeTaskStatus(taskId, status_code) {
    $.ajax({
        type: "POST",
        url: `/todoListTask/${taskId}`,
        data: {
            'taskId': taskId,
            'statusCode': status_code
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: "JSON",
        success (response) {
            console.log(response);
        },
        error (response) {
            console.log(response);
        }
    });
}

$('#createTodoBtn').click((e) => {
    const project_id = e.currentTarget.dataset.project_id;

    $.ajax({
        type: "POST",
        url: "/todoList",
        data: {
            'project_id': project_id
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: "JSON",
        success(response) {
            if (response.created) {
                $('#create-resource').modal('hide');
                $('#myTab').html(`
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todoTabPanel" role="tab" aria-controls="home" aria-selected="true">To Do список</a>
                    </li>`);

                $('#myTabContent').html(`
                `);
            } else {
                $('#resource-message').text(response.message);
            }
        }
    });
});

$('#project-body').on('click', '#add_todoTask', () => {
    const newTodoTaskForm = $('#new_todoTask');

    if (newTodoTaskForm.hasClass('d-none')) {
        newTodoTaskForm.removeClass('d-none');
    } else {
        newTodoTaskForm.addClass('d-none');
        $('#todoTask').removeClass('validation_error');
        newTodoTaskForm.children('.invalid-feedback').remove();
    }
});

$('#new_todoTask').submit(function (e) {
    e.preventDefault();
});

$('#project-body').on('click', '#create_todoTask', (e) => {
    const newTask = $('#todoTask');
    $.ajax({
        type: "POST",
        url: "/todoListTask",
        data: {
            todoList_id: e.currentTarget.dataset.todolist_id,
            todoTask_text: newTask.val()
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: "JSON",
        success(response) {
            const newTask = response.newTask[0];
            $('#todo-body').prepend(`
                <tr>
                    <td>${newTask.text}</td>
                    <td>${newTask.status}</td>
                    <td class="text-right">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-warning mr-2 taskPending" title="В процессе" data-todolist_id="{{ $todolist[0]->id }}" data-taskid="{{ $task->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                </svg>
                            </button>
                            <button type="button" class="btn btn-secondary taskUnfinished mr-2" style="background-color: #3b5360" title="Не выполнено" data-todolist_id="{{ $todolist[0]->id }}" data-taskid="{{ $task->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-dash" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M5.5 6.5A.5.5 0 0 1 6 6h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"/>
                                    <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
                                </svg>
                            </button>
                            <button type="button" class="btn btn-success taskFinished" title="Выполнено" data-todolist_id="{{ $todolist[0]->id }}" data-taskid="{{ $task->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
                                    <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>`);
        },
        error(response) {
            const errors = response.responseJSON.errors;

            newTask.addClass('validation_error');
            $(`<div class="invalid-feedback">${errors.todoTask_text}</div>`).insertAfter(newTask);
        }
    });
});


$('#todoTabPanel').on('click', '.taskFinished', (e) => {
    changeTaskStatus(e.currentTarget.dataset.taskid, 2)
});

$('#todoTabPanel').on('click', '.taskUnfinished', (e) => {
    changeTaskStatus(e.currentTarget.dataset.taskid, 1)
});

$('#todoTabPanel').on('click', '.taskPending', (e) => {
    changeTaskStatus(e.currentTarget.dataset.taskid, 3)
});
