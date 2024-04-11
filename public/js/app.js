const showErrorMessage = (error, title = "ERROR!") => {
    Swal.fire({
        icon: "error",
        title: title,
        html: error,
        showCloseButton: true,
    });
}

const showSuccesMessageWithRedirect = (msg, url, title = 'LISTO!') => {
    Swal.fire({
        title: title,
        text: msg,
        showCloseButton: true,
        icon: "success",
    }).then(() => {
        window.location.href = url;
    });
}

const showSuccesMessage = (msg, title = "LISTO!") => {
    Swal.fire({
        title: title,
        text: msg,
        showCloseButton: true,
        icon: "success",
    });
}

const askIfSure = (msg, action, denyAction, title = "SEGURO?") => {
    Swal.fire({
        title: title,
        html: msg,
        icon: "question",
        showCloseButton: true,
        showDenyButton: true,
        denyButtonText: "No",
        confirmButtonText: "Si"
    }).then((result) => {
        if(result.isConfirmed)
            action();
        else
            denyAction();
    });
}

const showLoadingIcon = () => {
    $('#loadingIcon').show();
}

const hideLoadingIcon = () => {
    $('#loadingIcon').hide();
}