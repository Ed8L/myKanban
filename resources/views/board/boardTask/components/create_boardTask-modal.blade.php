<div class="modal fade" id="create_boardTask-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Создать задачу</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" id="boardTaskText" class="form-control" name="text" placeholder="Задача">
                </div>
                <div class="form-group">
                    <textarea id="boardTaskNote" class="form-control" name="note" placeholder="Описание (по желанию)"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" id="createBoardTask" class="btn btn-primary">Создать</button>
            </div>
        </div>
    </div>
</div>
