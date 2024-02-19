document.addEventListener('DOMContentLoaded', function() {
    var modalElement = document.getElementById('modal_nova_receita');
    modalElement.addEventListener('hidden.bs.modal', function() {
        location.reload();
    });
});