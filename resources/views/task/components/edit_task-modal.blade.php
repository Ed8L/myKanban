<div class="modal fade" id="edit_task-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Задача">
                </div>
                <input type="date" class="form-control mb-3" id="taskDue">
                <select name="status" class="form-control mb-3">
                    <option value="0">Не выполнено</option>
                    <option value="1">Выполнено</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="deleteTask">Удалить</button>
                <button type="button" class="btn btn-primary" id="editTask">Сохранить</button>
            </div>
        </div>
    </div>
</div>
