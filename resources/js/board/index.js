$(document).ready(() => {
    const editBoardModal = $('#edit_board-modal');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //Создать доску
    $('#createBoard').click((e) => {
        $.ajax({
            type: 'POST',
            url: '/board',
            data: {
                'project_id': e.currentTarget.dataset.project_id,
                'title': $('#boardTitle').val()
            },
            dataType: 'JSON',
            success(response) {
                if (response.created) {
                    const boardHtml = createBoardHtml(response.board);
                    $('.boards-row').append(boardHtml);
                    $('#create_board-modal').modal('hide');
                }
            },
            error(response) {
                const errors = response.responseJSON.errors;
                $(`<div class="invalid-feedback">${errors.title[0]}</div>`).insertAfter($('#boardTitle'));
            }
        });
    });

    //Открыть модальное окно и заполнить input именем доски
    $('.boards-row').on('click', '.board-title', (e) => {
        e.preventDefault();

        const boardId = e.currentTarget.dataset.board_id;

        $.ajax({
            method: 'GET',
            url: `/board/${boardId}/edit`,
            dataType: 'JSON',
            success(response) {
                const board = response.board;

                editBoardModal.find('.modal-title').text(board.title);
                editBoardModal.find('[type="text"]').val(board.title);

                document.querySelector('#editBoard').dataset.board_id = board.id;
                document.querySelector('#deleteBoard').dataset.board_id = board.id;

                editBoardModal.modal('show');
            }
        });
    });

    //Редактировать доску
    $('#editBoard').click((e) => {
        const boardTitle = editBoardModal.find('[type="text"]');
        const boardId = e.currentTarget.dataset.board_id;

        $.ajax({
            method: 'PATCH',
            url: `/board/${boardId}`,
            data: {
                title: boardTitle.val()
            },
            dataType: 'JSON',
            success(response) {
                if (response.updated) {
                    $(`#board-${boardId}`).find('.board-title').text(response.newTitle);
                }
            },
            error(response) {
                const errors = response.responseJSON.errors;
                $(`<div class="invalid-feedback">${errors.title[0]}</div>`).insertAfter(boardTitle);
            }
        });
    });

    //Удалить доску
    $('#deleteBoard').click((e) => {
        const boardId = e.currentTarget.dataset.board_id;

        $.ajax({
            method: 'DELETE',
            url: `/board/${boardId}`,
            dataType: 'JSON',
            success(response) {
                if (response.deleted) {
                    $(`#board-${boardId}`).remove();
                    editBoardModal.modal('hide');
                }
            }
        });
    });

    //Верстка доски
    function createBoardHtml(board) {
        return `<div class="col-8 col-sm-6 col-md-5 col-lg-3 card-col" id="board-${board.id}">
                    <div class="card board">
                        <div class="card-header">
                            <a href="" class="board-title" data-board_id="${board.id}">${board.title}</a>
                        </div>
                        <div class="card-body">
                        </div>
                        <div class="card-footer">
                            <a href="" class="createBoardTaskBtn" data-board_id="${board.id}">Добавить задачу</a>
                        </div>
                    </div>
                </div>`;
    }
});
