$(document).ready(() => {
    const boards = $('.board-tasks');

    boards.each((index, value) => {
        new Sortable(value, {
            handle: '.boardTask-card',
            group: 'shared',
            animation: 200,

            onChange: function (evt) {
                const sortedTaskId = evt.item.dataset.boardtaskid;
                const newBoardId = evt.to.dataset.board_id;

                $.ajax({
                    method: 'PATCH',
                    url: `/boardTaskSort/${sortedTaskId}`,
                    data: {
                        'boardId': newBoardId
                    }
                });
            }
        });
    });

    const createBoardTaskModal = $('#create_boardTask-modal');
    const editBoardTaskModal = $('#edit_boardTask-modal');

    createBoardTaskModal.on('hidden.bs.modal', () => {
        createBoardTaskModal.find('input').val('');
        createBoardTaskModal.find('textarea').val('');
    })

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function newBoardTaskHtml(boardTask) {
        return `<div class="card mb-3 boardTask-card" id="boardTask-${boardTask.id}">
                    <a class="card-body boardTask-text" data-boardTask_id="${boardTask.id}">
                        ${boardTask.text}
                    </a>
                </div>`
    }

    //Передача board_id в модальное окно для создания задачи
    $('.boards-row').on('click', '.createBoardTaskBtn', (e) => {
        e.preventDefault();
        const boardId = e.currentTarget.dataset.board_id;

        document.getElementById('createBoardTask').dataset.board_id = boardId;

        createBoardTaskModal.modal('show');
    });

    //Создание задачи
    $('.boards-row').on('click', '#createBoardTask', (e) => {
        const boardTaskText = $('#boardTaskText');
        const boardTaskNote = $('#boardTaskNote');
        const boardId = e.currentTarget.dataset.board_id;

        $.ajax({
            method: 'POST',
            url: '/boardTask',
            data: {
                'board_id': boardId,
                'text': boardTaskText.val(),
                'note': boardTaskNote.val()
            },
            dataType: 'JSON',
            success(response) {
                const newBoardTask = 123;
                $(`#board-${boardId}`).find('.board-tasks').prepend(newBoardTask);
            },
            error(response) {
                const errors = response.responseJSON.errors;

                $.each(errors, (column,
                                errorMsg,
                                input = createBoardTaskModal.find(`[name="${column}"]`)
                ) => {
                    $(`<div class="invalid-feedback">${errorMsg}</div>`).insertAfter(input);
                });
            }
        });
    });

    //Передача данных для редактирования в модальное окно
    $('.board-tasks').on('click', '.boardTask-text', (e) => {
        const boardTaskId = e.currentTarget.dataset.boardtask_id;

        $.ajax({
            method: 'GET',
            url: `/boardTask/${boardTaskId}/edit`,
            dataType: 'JSON',
            success(response) {
                if (response.success) {
                    const boardTask = response.boardTask;

                    editBoardTaskModal.find('.modal-title').text(boardTask.text);
                    editBoardTaskModal.find('[name="text"]').val(boardTask.text);
                    editBoardTaskModal.find('[name="note"]').val(boardTask.note);

                    document.querySelector('#editBoardTask').dataset.boardTask_id = boardTask.id
                    document.querySelector('#deleteBoardTask').dataset.boardTask_id = boardTask.id

                    editBoardTaskModal.modal('show');
                }
            }
        });

    });

    //Редактирование задачи
    $('#editBoardTask').click((e) => {
        const boardTaskId = Number(e.currentTarget.dataset.boardTask_id);
        const boardTaskText = editBoardTaskModal.find('[name="text"]');
        const boardTaskNote = editBoardTaskModal.find('[name="note"]');

        $.ajax({
            method: 'PATCH',
            url: `/boardTask/${boardTaskId}`,
            data: {
                'id': boardTaskId,
                'text': boardTaskText.val(),
                'note': boardTaskNote.val()
            },
            dataType: 'JSON',
            success(response) {
                if (response.success) {
                    const boardTask = response.boardTask;
                    $(`#boardTask-${boardTaskId}`).find('.boardTask-text').text(boardTask.text);
                    editBoardTaskModal.modal('hide');
                }
            },
            error(response) {
                const errors = response.responseJSON.errors;

                $.each(errors, (column,
                                errorMsg,
                                input = editBoardTaskModal.find(`[name="${column}"]`)
                ) => {
                    $(`<div class="invalid-feedback">${errorMsg}</div>`).insertAfter(input);
                });
            }
        });
    });

    //Удаление задачи
    $('#deleteBoardTask').click((e) => {
        const boardTaskId = Number(e.currentTarget.dataset.boardTask_id);

        $.ajax({
            method: 'DELETE',
            url: `/boardTask/${boardTaskId}`,
            dataType: 'JSON',
            success(response) {
                if (response.success) {
                    $(`#boardTask-${boardTaskId}`).remove();
                    editBoardTaskModal.modal('hide');
                }
            }
        });
    });
});
