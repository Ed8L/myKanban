$(document).ready(function () {
    const project_title = $('#createProjectForm').children('.form-group').children('#project_title');
    const createdMsg = $('#create_msg');

    function clearModal() {
        project_title.removeClass('validation_error');
        $('.invalid-feedback').remove();
    }

    function addProject() {
        $.ajax({
            type: "POST",
            url: "/project",
            data: {
                'title': project_title.val()
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "JSON",
            success(response) {
                if (response.created) {
                    const newProject = response.newProject;
                    $('#empty-message').remove();

                    $('#projects-row').append(`
                    <div class="col-lg-4 col-md-6">
                    <div class="card project mb-3">
                        <a class="project-title" href="project/${newProject.id}">
                            <div class="card-body text-center">
                                <p>${newProject.title}</p>
                            </div>
                        </a>
                    </div>
                </div>`);

                    clearModal();
                    createdMsg.text('Проект создан!');
                }
            },

            error(response) {
                if (response.responseJSON.errors) {
                    clearModal();
                    const errors = response.responseJSON.errors;

                    project_title.addClass('validation_error');
                    $(`<div class="invalid-feedback">${errors.title}</div>`).insertAfter(project_title);
                }
            }
        });
    }

    $('#createProjectModal').on('hidden.bs.modal', () => {
        clearModal();
        createdMsg.remove();
        project_title.val('');
    });

    $('#createProject-btn').click((e) => {
        e.preventDefault();
        addProject();
    });
});
