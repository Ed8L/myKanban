<div class="modal fade" id="createProjectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Создать проект</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="closeModal-btn" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createProjectForm">
                    @csrf
                    <div class="form-group">
                        <label for="project_title">Название</label>
                        <input type="text" class="form-control" id="project_title" name="project_title" placeholder="Введите название доски" value="{{ old('project_title') }}">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div id="create_msg"></div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" id="createProject-btn">Создать проект</button>
            </div>
        </div>
    </div>
</div>
