$(document).ready(() => {
    const createBoardTaskModal = $('#create_boardTask-modal');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function newBoardTaskHtml(boardTask) {
        return `<div class="card mb-3 boardTask-card">
                    <div class="card-body">
                        ${boardTask.text}
                    </div>
                </div>`
    }

    //Передача board_id в модальное окно
    $('.boards-row').on('click', '.createBoardTaskBtn', (e) => {
        e.preventDefault();
        const boardId = e.currentTarget.dataset.board_id;

        document.querySelector('#createBoardTask').dataset.board_id = boardId

        createBoardTaskModal.modal('show');
    });

    //Создание задачи
    $('#createBoardTask').click((e) => {
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
                const newBoardTask = newBoardTaskHtml(response.boardTask);
                $(`#board-${boardId}`).find('.board-tasks').append(newBoardTask);
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
});
