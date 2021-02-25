<div class="modal fade" id="edit_boardTask-modal" tabindex="-1" aria-hidden="true">
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
                    <label>Задача</label>
                    <input type="text" class="form-control" name="text" placeholder="Задача">
                </div>
                <div class="form-group">
                    <label>Описание</label>
                    <textarea class="form-control" name="note" placeholder="Описание (по желанию)"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="deleteBoardTask">Удалить</button>
                <button type="button" id="editBoardTask" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </div>
</div>
