$(document).ready(() => {
    $('.alert').alert();

    const newTitleInput = $('#project_newTitle-input'); // renaming project input
    const editProjectModal = $('#edit_project-modal');

    function clearModal(modalSelector) {
        modalSelector.find('.invalid-feedback').remove();
        modalSelector.find('.c-red').remove();
    }

    // Fill input with project name
    $('.project-edit').click((e) => {
        newTitleInput.val(e.currentTarget.dataset.name);
        newTitleInput.data('id', e.currentTarget.dataset.id);
    });

    editProjectModal.on('hidden.bs.modal', function (e) {
        clearModal(editProjectModal);
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.delete_project-btn').click((e) => {
        if (window.confirm("Вы уверены что хотите удалить этот проект?")) {
            const projectId = Number(e.currentTarget.dataset.id);

            $.ajax({
                type: 'DELETE',
                url: `/project/${projectId}`,
                dataType: 'JSON',
                success(response) {
                    if (response.deleted) {
                        $('#project-' + projectId).remove();
                    } else {
                        alert(response.msg);
                    }
                }
            });
        }
    });

    $('.edit_project-btn').click(() => {
        const projectId = Number(newTitleInput.data('id'));
        $.ajax({
            type: 'PATCH',
            url: `/project/${projectId}`,
            data: {
                'id': projectId,
                'title': newTitleInput.val()
            },
            dataType: 'JSON',
            success(response) {
                if (response.updated) {
                    const project = $('#project-' + projectId);

                    project.find('.project-title').text(response.updatedTitle);
                    project.find('.project-edit').attr('data-name', response.updatedTitle);

                    editProjectModal.modal('hide');
                } else {
                    editProjectModal.find('.modal-footer').prepend(`<span class="c-red">${response.msg}</span>`);
                }
            },
            error(response) {
                clearModal(editProjectModal);

                const errors = response.responseJSON.errors;
                if (errors.id) {
                    alert(errors.id[0]);
                    location.reload();
                }

                editProjectModal.find('.modal-body').append(`<div class="invalid-feedback">${errors.title[0]}</div>`);
            }
        });
    });
});
