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
                console.log(response);
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
