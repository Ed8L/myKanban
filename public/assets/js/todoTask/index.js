/******/ (() => { // webpackBootstrap
/*!****************************************!*\
  !*** ./resources/js/todoTask/index.js ***!
  \****************************************/
$(document).ready(function () {
  var taskModal = $('#edit_task-modal');
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $('#addTaskForm').submit(function (e) {
    e.preventDefault();
    $('.invalid-feedback').remove();
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
          var newTaskHTML = "<tr class=\"task\" data-taskId=\"".concat(newTask.id, "\">\n                                            <td>\u041D\u0435 \u0432\u044B\u043F\u043E\u043B\u043D\u0435\u043D\u043E</td>\n                                            <td>").concat(newTask.text, "</td>\n                                            <td>").concat(due, "</td>\n                                        </tr>");
          $('#todoListBody').prepend(newTaskHTML);
        }
      },
      error: function error(response) {
        if (response.responseJSON.errors.text) {
          $("<div class=\"invalid-feedback\">".concat(response.responseJSON.errors.text[0], "</div>")).insertAfter('#taskText');
        }

        if (response.responseJSON.errors.due) {
          $("<div class=\"invalid-feedback\">".concat(response.responseJSON.errors.due[0], "</div>")).insertAfter('#taskDueDate');
        }
      }
    });
  });
  $('#todoListBody').on('click', '.task', function (e) {
    var taskId = Number(e.currentTarget.dataset.taskid);
    $.ajax({
      type: 'GET',
      url: "/task/".concat(taskId, "/edit"),
      dataType: 'JSON',
      success: function success(response) {
        if (response.found) {
          var task = response.task;
          taskModal.find('.modal-title').text(task.text);
          taskModal.find('[type="text"]').val(task.text);
          document.querySelector('#taskDue').valueAsDate = new Date(task.due);
          document.querySelector('#editTask').dataset.taskId = taskId;
          document.querySelector('#deleteTask').dataset.taskId = taskId;
          taskModal.find("option[value=\"".concat(task.completed, "\"]")).attr('selected', 'selected');
          taskModal.modal('show');
        }
      }
    });
  });
  $('#editTask').click(function (e) {
    var taskInput = taskModal.find('[type="text"]');
    var taskDue = taskModal.find('[type="date"]');
    var taskId = Number(e.currentTarget.dataset.taskId);
    var status = Number($('[name="status"]').val());
    $.ajax({
      method: 'PATCH',
      url: "/task/".concat(taskId),
      data: {
        'text': taskInput.val(),
        'completed': status,
        'due': taskDue.val()
      },
      dataType: 'JSON',
      success: function success(response) {
        if (response.updated) {
          var task = response.task;
          var trow = $("tr[data-taskid=\"".concat(task.id, "\"]"));
          trow.find('td').first().text(task.completed);
          trow.find('td')[1].innerText = task.text;
          trow.find('td')[2].innerText = task.due;
          taskModal.modal('hide');
        }
      },
      error: function error(response) {
        var error = response.responseJSON.errors;
        var textInput = taskModal.find('[type="text"]');
        $("<div class=\"invalid-feedback\">".concat(error.text, "</div>")).insertAfter(textInput);
      }
    });
  });
  $('#deleteTask').click(function (e) {
    var taskId = Number(e.currentTarget.dataset.taskId);
    $.ajax({
      method: 'DELETE',
      url: "/task/".concat(taskId),
      dataType: 'JSON',
      success: function success(response) {
        if (response.deleted) {
          var trow = $("tr[data-taskid=\"".concat(taskId, "\"]"));
          trow.remove();
        }
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