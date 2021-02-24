/******/ (() => { // webpackBootstrap
/*!*****************************************!*\
  !*** ./resources/js/boardTask/index.js ***!
  \*****************************************/
$(document).ready(function () {
  var createBoardTaskModal = $('#create_boardTask-modal');
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  function newBoardTaskHtml(boardTask) {
    return "<div class=\"card mb-3 boardTask-card\">\n                    <div class=\"card-body\">\n                        ".concat(boardTask.text, "\n                    </div>\n                </div>");
  } //Передача board_id в модальное окно


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
        $("#board-".concat(boardId)).find('.board-tasks').append(newBoardTask);
      },
      error: function error(response) {
        var errors = response.responseJSON.errors;
        $.each(errors, function (column, errorMsg) {
          var input = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : createBoardTaskModal.find("[name=\"".concat(column, "\"]"));
          $("<div class=\"invalid-feedback\">".concat(errorMsg, "</div>")).insertAfter(input);
        });
      }
    });
  });
});
/******/ })()
;