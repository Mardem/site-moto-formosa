function deleteItem(btn) {
    Swal.fire({
        title: 'Você tem certeza?',
        text: "Essa ação não pode ser revertida!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sim, apagar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            let button = document.querySelector('#' + btn);
            let form = button.dataset.formId;
            document.getElementById(form).submit();
        }
    })
}
