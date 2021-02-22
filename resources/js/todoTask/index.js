$(document).ready(() => {
    const taskModal = $('#edit_task-modal');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#addTaskForm').submit((e) => {
        e.preventDefault();
        $('.invalid-feedback').remove();
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
                    const due = formatDate(newTask.due);

                    const newTaskHTML = `<tr>
                                            <td>input</td>
                                            <td>${newTask.text}</td>
                                            <td>${due}</td>
                                        </tr>`;

                    $('#todoListBody').prepend(newTaskHTML);
                }
            },
            error(response) {
                if (response.responseJSON.errors.text) {
                    $(`<div class="invalid-feedback">${response.responseJSON.errors.text[0]}</div>`).insertAfter('#taskText')
                }
                if (response.responseJSON.errors.due) {
                    $(`<div class="invalid-feedback">${response.responseJSON.errors.due[0]}</div>`).insertAfter('#taskDueDate')
                }
            }
        });
    });

    $('#todoListBody').on('click', '.task', (e) => {
        const taskId = Number(e.currentTarget.dataset.taskid);

        $.ajax({
            type: 'GET',
            url: `/task/${taskId}`,
            dataType: 'JSON',
            success(response) {
                if (response.found) {
                    const task = response.task;

                    taskModal.find('.modal-title').text(task.text);
                    taskModal.find('[type="text"]').val(task.text);
                    document.querySelector('#taskDue').valueAsDate = new Date(task.due);

                    document.querySelector('#editTask').dataset.taskId = taskId;
                    document.querySelector('#deleteTask').dataset.taskId = taskId;

                    taskModal.find(`option[value="${task.completed}"]`).attr('selected', 'selected');

                    taskModal.modal('show');
                }
            }
        });
    });

    $('#editTask').click((e) => {
        const taskInput = taskModal.find('[type="text"]');
        const taskDue = taskModal.find('[type="date"]');
        const taskId = Number(e.currentTarget.dataset.taskId);
        const status = Number($('[name="status"]').val());

        $.ajax({
            method: 'PATCH',
            url: `/task/${taskId}`,
            data: {
                'text': taskInput.val(),
                'completed': status,
                'due': taskDue.val(),
            },
            dataType: 'JSON',
            success(response) {
                if (response.updated) {
                    const task = response.task;

                    const trow = $(`tr[data-taskid="${task.id}"]`);

                    trow.find('td').first().text(task.completed);
                    trow.find('td')[1].innerText = task.text;
                    trow.find('td')[2].innerText = task.due;

                    taskModal.modal('hide');
                }
            },
            error(response) {
                const error = response.responseJSON.errors;
                const textInput = taskModal.find('[type="text"]');

                $(`<div class="invalid-feedback">${error.text}</div>`).insertAfter(textInput);
            }
        });
    });

    $('#deleteTask').click((e) => {
        const taskId = Number(e.currentTarget.dataset.taskId);

        $.ajax({
            method: 'DELETE',
            url: `/task/${taskId}`,
            dataType: 'JSON',
            success(response) {
                if(response.deleted) {
                    const trow = $(`tr[data-taskid="${taskId}"]`);
                    trow.remove();
                }
            }
        });
    });

    function formatDate(date) {
        const dueObject = new Date(date);
        const months = {
            0: 'Января', 1: 'Февраля', 2: 'Марта', 3: 'Апреля', 4: 'Мая', 5: 'Июня',
            6: 'Июля', 7: 'Августа', 8: 'Сентября', 9: 'Октября', 10: 'Ноября', 11: 'Декабря',
        };

        let day = date.slice(-2);
        const month = months[dueObject.getMonth()];

        if (day[0] === '0') {
            day = day.slice(-1);
        }

        return day + ' ' + month;
    }
});
