/******/ (() => { // webpackBootstrap
/*!*****************************************!*\
  !*** ./resources/js/boardTask/index.js ***!
  \*****************************************/
$(document).ready(function () {
  var createBoardTaskModal = $('#create_boardTask-modal');
  var editBoardTaskModal = $('#edit_boardTask-modal');
  createBoardTaskModal.on('hidden.bs.modal', function () {
    createBoardTaskModal.find('input').val('');
    createBoardTaskModal.find('textarea').val('');
  });
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  function newBoardTaskHtml(boardTask) {
    return "<div class=\"card mb-3 boardTask-card\" id=\"boardTask-".concat(boardTask.id, "\">\n                    <a class=\"card-body boardTask-text\" data-boardTask_id=\"").concat(boardTask.id, "\">\n                        ").concat(boardTask.text, "\n                    </a>\n                </div>");
  } //Передача board_id в модальное окно для создания задачи


  $('.boards-row').on('click', '.createBoardTaskBtn', function (e) {
    e.preventDefault();
    var boardId = e.currentTarget.dataset.board_id;
    document.querySelector('#createBoardTask').dataset.board_id = boardId;
    createBoardTaskModal.modal('show');
  }); //Создание задачи

  $('#createBoardTask').click(function (e) {
    var boardTaskText = $('#boardTaskText');
    var boardTaskNote = $('#boardTaskNote');
    var boardId = e.currentTarget.dataset.board_id;
    $.ajax({
      method: 'POST',
      url: '/boardTask',
      data: {
        'board_id': boardId,
        'text': boardTaskText.val(),
        'note': boardTaskNote.val()
      },
      dataType: 'JSON',
      success: function success(response) {
        var newBoardTask = newBoardTaskHtml(response.boardTask);
        $("#board-".concat(boardId)).find('.board-tasks').prepend(newBoardTask);
      },
      error: function error(response) {
        var errors = response.responseJSON.errors;
        $.each(errors, function (column, errorMsg) {
          var input = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : createBoardTaskModal.find("[name=\"".concat(column, "\"]"));
          $("<div class=\"invalid-feedback\">".concat(errorMsg, "</div>")).insertAfter(input);
        });
      }
    });
  }); //Передача данных для редактирования в модальное окно

  $('.board-tasks').on('click', '.boardTask-text', function (e) {
    var boardTaskId = e.currentTarget.dataset.boardtask_id;
    $.ajax({
      method: 'GET',
      url: "/boardTask/".concat(boardTaskId, "/edit"),
      dataType: 'JSON',
      success: function success(response) {
        if (response.success) {
          var boardTask = response.boardTask;
          editBoardTaskModal.find('.modal-title').text(boardTask.text);
          editBoardTaskModal.find('[name="text"]').val(boardTask.text);
          editBoardTaskModal.find('[name="note"]').val(boardTask.note);
          document.querySelector('#editBoardTask').dataset.boardTask_id = boardTask.id;
          document.querySelector('#deleteBoardTask').dataset.boardTask_id = boardTask.id;
          editBoardTaskModal.modal('show');
        }
      }
    });
  }); //Редактирование задачи

  $('#editBoardTask').click(function (e) {
    var boardTaskId = Number(e.currentTarget.dataset.boardTask_id);
    var boardTaskText = editBoardTaskModal.find('[name="text"]');
    var boardTaskNote = editBoardTaskModal.find('[name="note"]');
    $.ajax({
      method: 'PATCH',
      url: "/boardTask/".concat(boardTaskId),
      data: {
        'id': boardTaskId,
        'text': boardTaskText.val(),
        'note': boardTaskNote.val()
      },
      dataType: 'JSON',
      success: function success(response) {
        if (response.success) {
          var boardTask = response.boardTask;
          $("#boardTask-".concat(boardTaskId)).find('.boardTask-text').text(boardTask.text);
          editBoardTaskModal.modal('hide');
        }
      },
      error: function error(response) {
        var errors = response.responseJSON.errors;
        $.each(errors, function (column, errorMsg) {
          var input = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : editBoardTaskModal.find("[name=\"".concat(column, "\"]"));
          $("<div class=\"invalid-feedback\">".concat(errorMsg, "</div>")).insertAfter(input);
        });
      }
    });
  }); //Удаление задачи

  $('#deleteBoardTask').click(function (e) {
    var boardTaskId = Number(e.currentTarget.dataset.boardTask_id);
    $.ajax({
      method: 'DELETE',
      url: "/boardTask/".concat(boardTaskId),
      dataType: 'JSON',
      success: function success(response) {
        if (response.success) {
          $("#boardTask-".concat(boardTaskId)).remove();
          editBoardTaskModal.modal('hide');
        }
      }
    });
  });
});
/******/ })()
;