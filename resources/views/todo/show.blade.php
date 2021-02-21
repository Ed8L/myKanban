<div class="card inner-card">
    <div class="card-body">
        <div class="container-fluid">
            <form id="addTaskForm">
                <div class="row mb-2">
                    <div class="col-12">
                        <input type="text" class="form-control"
                               placeholder="Что вам нужно сделать?" id="taskText">
                    </div>
                    <div class="col-12 col-sm-5 col-md-5 mt-2">
                        <input type="date" id="taskDueDate" class="form-control">
                    </div>
                    <div class="col-12 col-sm-1 col-md-1 mt-2 text-right">
                        <button class="btn btn-primary" id="add-task" data-todoId="{{ $todo->id }}">Добавить</button>
                    </div>
                </div>
            </form>

            <div class="table-responsive mt-3">
                <table class="table table-bordered todo-table">
                    <thead class="todo-thead">
                    <tr>
                        <th width="15%" scope="col">Статус</th>
                        <th>Задача</th>
                        <th width="20%" scope="col">Срок</th>
                    </tr>
                    </thead>
                    <tbody id="todoListBody">
                        @include('task.index')
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
