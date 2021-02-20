/******/ (() => { // webpackBootstrap
/*!****************************************!*\
  !*** ./resources/js/todoTask/index.js ***!
  \****************************************/
$(document).ready(function () {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $('#addTaskForm').submit(function (e) {
    e.preventDefault();
    var taskText = $('#taskText');
    var todoId = $('#add-task').attr('data-todoId');
    var taskDueDate = $('#taskDueDate');
    $.ajax({
      type: 'POST',
      url: '/task',
      dataType: 'JSON',
      data: {
        'todo_list_id': todoId,
        'text': taskText.val(),
        'due': taskDueDate.val()
      },
      success: function success(response) {
        if (response.created) {
          var newTask = response.newTask;
          var newTaskHTML = "<tr>\n                                            <td>input</td>\n                                            <td>".concat(newTask.text, "</td>\n                                            <td>").concat(newTask.due, "</td>\n                                        </tr>");
          $('#todoListBody').prepend(newTaskHTML);
        }
      },
      error: function error(response) {
        console.log(response);
      }
    });
  });
});
/******/ })()
;