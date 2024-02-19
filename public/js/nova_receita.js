document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('#modal_nova_receita .modal-footer .btn-primary').addEventListener('click', function() {
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var pdfFile = document.querySelector('#inputGroupFile01').files[0];
        var imageFile = document.querySelector('#inputGroupFile02').files[0];
        var tituloReceita = document.querySelector('#titulo_receita').value;
        var statusEnvio = document.getElementById('div_status_envio');

        statusEnvio.innerHTML = ''; // Limpa o conteúdo anterior

        if (!csrfToken || !pdfFile || !imageFile || !tituloReceita) {
            if (!csrfToken) {
                statusEnvio.innerHTML += '<p class="m-0">ERRO: csrfToken não anexado</p>';
            }
            if (!pdfFile) {
                statusEnvio.innerHTML += '<p class="m-0">ERRO: PDF não anexado</p>';
            }
            if (!imageFile) {
                statusEnvio.innerHTML += '<p class="m-0">ERRO: Imagem não anexada</p>';
            }
            if (!tituloReceita) {
                statusEnvio.innerHTML += '<p class="m-0">ERRO: Título não inserido</p>';
            }
            return;
        }

        if (pdfFile && imageFile && tituloReceita && csrfToken) {
            var formData = new FormData();
            formData.append('_token', csrfToken);
            formData.append('pdfFile', pdfFile);
            formData.append('imageFile', imageFile);
            formData.append('tituloReceita', tituloReceita);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/salvar_receita');
            xhr.send(formData);

            xhr.onload = function() {
                if (xhr.status === 200) {
                    statusEnvio.innerHTML = 'Dados enviados com sucesso!';
                } else {
                    statusEnvio.innerHTML = 'Erro ao enviar dados: ' + xhr.statusText;
                }
            };
            xhr.onerror = function() {
                statusEnvio.innerHTML = 'Erro de conexão';
            };
        }
    });
});