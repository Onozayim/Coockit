$(document).ready(function () {
    const receta_id = $("#receta_id").val();
    let page = 1;
    let moreComments = true;
    let inProcess = false;

    $("#saveOnFavorites").on("click", function (e) {
        $(this).prop("disabled", true);

        //Save receta en favorito
        askIfSure(
            "Estas seguro que quieres guardar la receta en Favoritos?",
            () => {
                $.post("/ajax/saveFavorite", { receta_id })
                    .done(function () {
                        showSuccesMessage("Receta guardada en favoritos");
                        $("#saveOnFavorites").remove();
                    })
                    .fail(function (data) {
                        showErrorMessage(data.responseJSON.msg);
                        $("#saveOnFavorites").removeAttr("disabled");
                    });
            },
            () => {
                $("#saveOnFavorites").removeAttr("disabled");
            }
        );
    });

    $("#verifyReceta").on("click", function (e) {
        $(this).prop("disabled", true);

        //Administrador verifica receta
        askIfSure(
            "Estas seguro que quieres verificar la receta?",
            () => {
                $.post("/ajax/verifyReceta", { receta_id })
                    .done(function (data) {
                        showSuccesMessage("Receta aprobada!");

                        $("#dennyReceta").remove();
                        $("#verifyReceta").remove();
                    })
                    .fail(function (data) {
                        showErrorMessage(data.responseJSON.msg);
                        $("#verifyReceta").removeAttr("disabled");
                    });
            },
            () => {
                $("#verifyReceta").removeAttr("disabled");
            }
        );
    });

    $("#dennyReceta").on("click", function (e) {
        $(this).prop("disabled", true);

        //Administrador verifica receta
        askIfSure(
            "Estas seguro que quieres verificar la receta?",
            () => {
                $.post("/ajax/dennyReceta", { receta_id })
                    .done(function () {
                        showSuccesMessage("Receta Rechazada");

                        $("#dennyReceta").remove();
                        $("#verifyReceta").remove();
                    })
                    .fail(function (data) {
                        showErrorMessage(data.responseJSON.msg);
                        $("#dennyReceta").removeAttr("disabled");
                    });
            },
            () => {
                $("#dennyReceta").removeAttr("disabled");
            }
        );
    });

    $("#saveComentario").submit(function (e) {
        e.preventDefault();
        $("#saveComentarioBtn").prop("disabled", true);

        const data = {
            comment: $("#comment").val(),
            grade: $("#grade").val(),
            receta_id: receta_id,
        };

        $.post("/ajax/saveComentario", data)
            .done(function (data) {
                showSuccesMessage("Calificación publicada!");

                $("#openComentarioModal").remove();
                $("#comentarioModal").modal("hide");
            })
            .fail(function (data) {
                showErrorMessage(data.responseJSON.msg);

                $("#saveComentarioBtn").removeAttr("disabled");
            });
    });

    $('#saveReceta').submit(function(e) {
        e.preventDefault();
        $("#saveRecetaBtn").prop('disabled', true);

        const data = {
            day: $("#day").val(),
            meal: $('#meal').val(),
            receta_id: receta_id
        };

        $.post('/ajax/saveRecetaInMeal', data)
            .done(function () {
                showSuccesMessage('Receta guardada!');

                $("#guardarModal").modal('hide');
                $('#saveRecetaBtn').removeAttr('disabled');
            })
            .fail(function (data) {
                showErrorMessage(data.responseJSON.msg);

                $('#saveRecetaBtn').removeAttr('disabled');
            })
    })

    const loadComments = () => {
        showLoadingIcon();

        const data = {
            receta_id,
            page,
        };

        inProcess = true;
        $.get("/ajax/loadComments", data).done(function (data) {
            data.comentarios.data.forEach((comentario) => {
                $("#comentariosContainer").append(`
                        <div>
                            <h3>${comentario.comment}</h3>
                            <p>${comentario.grade}</p>
                            <p>${comentario.user.name}</p>
                            <p>${comentario.created_at}</p>
                        </div>
                    `);
            });

            moreComments = !(
                data.comentarios.current_page >= data.comentarios.last_page
            );
            page++;
            inProcess = false;

            hideLoadingIcon();
        });
    };

    loadComments();

    $(window).scroll(function () {
        if (
            $(window).scrollTop() + $(window).height() >=
                $(document).height() - 100 &&
            moreComments &&
            !inProcess
        )
            loadComments();
    });
});
