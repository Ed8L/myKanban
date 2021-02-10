<div class="modal fade" id="create-resource" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="closeModal-btn" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="create__resource-block">
                    @if (count($todolist) ===0)
                        <button type="button" class="btn btn-secondary" id="createTodoBtn" data-project_id={{ $project->id }}>Создать ToDo список</button>
                    @else
                        <span data-toggle="popover" data-content="Можно создать только один To Do список на один проект">
                            <button type="button" class="btn btn-secondary" style="pointer-events: none;" type="button" disabled>Создать ToDo список</button>
                        </span>
                    @endif
                    <button type="button" class="btn btn-secondary">Создать доску</button>
                </div>
            </div>
            <div class="modal-footer">
                <span id="resource-message"></span>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>
