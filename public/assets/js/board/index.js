/******/ (() => { // webpackBootstrap
/*!*************************************!*\
  !*** ./resources/js/board/index.js ***!
  \*************************************/
$(document).ready(function () {
  var editBoardModal = $('#edit_board-modal');
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  }); //Создать доску

  $('#createBoard').click(function (e) {
    $.ajax({
      type: 'POST',
      url: '/board',
      data: {
        'project_id': e.currentTarget.dataset.project_id,
        'title': $('#boardTitle').val()
      },
      dataType: 'JSON',
      success: function success(response) {
        if (response.created) {
          var boardHtml = createBoardHtml(response.board);
          $('.boards-row').append(boardHtml);
          $('#create_board-modal').modal('hide');
        }
      },
      error: function error(response) {
        var errors = response.responseJSON.errors;
        $("<div class=\"invalid-feedback\">".concat(errors.title[0], "</div>")).insertAfter($('#boardTitle'));
      }
    });
  }); //Открыть модальное окно и заполнить input именем доски

  $('.boards-row').on('click', '.board-title', function (e) {
    e.preventDefault();
    var boardId = e.currentTarget.dataset.board_id;
    $.ajax({
      method: 'GET',
      url: "/board/".concat(boardId, "/edit"),
      dataType: 'JSON',
      success: function success(response) {
        var board = response.board;
        editBoardModal.find('.modal-title').text(board.title);
        editBoardModal.find('[type="text"]').val(board.title);
        document.querySelector('#editBoard').dataset.board_id = board.id;
        document.querySelector('#deleteBoard').dataset.board_id = board.id;
        editBoardModal.modal('show');
      }
    });
  }); //Редактировать доску

  $('#editBoard').click(function (e) {
    var boardTitle = editBoardModal.find('[type="text"]');
    var boardId = e.currentTarget.dataset.board_id;
    $.ajax({
      method: 'PATCH',
      url: "/board/".concat(boardId),
      data: {
        title: boardTitle.val()
      },
      dataType: 'JSON',
      success: function success(response) {
        if (response.updated) {
          $("#board-".concat(boardId)).find('.board-title').text(response.newTitle);
        }
      },
      error: function error(response) {
        var errors = response.responseJSON.errors;
        $("<div class=\"invalid-feedback\">".concat(errors.title[0], "</div>")).insertAfter(boardTitle);
      }
    });
  }); //Удалить доску

  $('#deleteBoard').click(function (e) {
    var boardId = e.currentTarget.dataset.board_id;
    $.ajax({
      method: 'DELETE',
      url: "/board/".concat(boardId),
      dataType: 'JSON',
      success: function success(response) {
        if (response.deleted) {
          $("#board-".concat(boardId)).remove();
          editBoardModal.modal('hide');
        }
      }
    });
  }); //Верстка доски

  function createBoardHtml(board) {
    return "<div class=\"col-8 col-sm-6 col-md-5 col-lg-3 card-col\">\n            <div class=\"card board\">\n                <div class=\"card-header\">\n                    <a href=\"\">".concat(board.title, "</a>\n                </div>\n                <div class=\"card-body\">\n                </div>\n                <div class=\"card-footer\">\n                    <a href=\"\">\u0414\u043E\u0431\u0430\u0432\u0438\u0442\u044C \u0437\u0430\u0434\u0430\u0447\u0443</a>\n                </div>\n            </div>\n        </div>");
  }
});
/******/ })()
;