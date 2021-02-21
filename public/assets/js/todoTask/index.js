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
          var due = formatDate(newTask.due);
          var newTaskHTML = "<tr>\n                                            <td>input</td>\n                                            <td>".concat(newTask.text, "</td>\n                                            <td>").concat(due, "</td>\n                                        </tr>");
          $('#todoListBody').prepend(newTaskHTML);
        }
      },
      error: function error(response) {
        console.log(response);
      }
    });
  });

  function formatDate(date) {
    var dueObject = new Date(date);
    var months = {
      0: 'Января',
      1: 'Февраля',
      2: 'Марта',
      3: 'Апреля',
      4: 'Мая',
      5: 'Июня',
      6: 'Июля',
      7: 'Августа',
      8: 'Сентября',
      9: 'Октября',
      10: 'Ноября',
      11: 'Декабря'
    };
    var day = date.slice(-2);
    var month = months[dueObject.getMonth()];

    if (day[0] === '0') {
      day = day.slice(-1);
    }

    return day + ' ' + month;
  }
});
/******/ })()
;