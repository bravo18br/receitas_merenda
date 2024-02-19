<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf_viewer.css">
    <link rel="stylesheet" href="css/receitas_merenda.css">
</head>

<body class="container" style="width: 100vw;">
    <div class="m-2" data-bs-toggle="modal" data-bs-target="#modal_nova_receita">
        <button type="button" class="btn btn-primary btn-lg" id="botao_incluir">Nova Receita</button>
    </div>
    @foreach ($receitas as $index => $receita)
    <div class="row linha_receita m-2 margem_suave">
        <div class="col-10">
            <div class="row p-1" data-bs-toggle="modal" data-bs-target="#modal{{$receita->id}}">
                @if ($index % 2 == 0)
                <div class="col d-flex flex-column align-items-center justify-content-center">
                    <img src="{{ asset($receita->imagem) }}" class="imagem_receita" alt="{{$receita->titulo}}">
                </div>
                <div class="col d-flex flex-column align-items-center justify-content-center">
                    <h5 class="card-title">{{$receita->titulo}}</h5>
                </div>
                @else
                <div class="col d-flex flex-column align-items-center justify-content-center">
                    <h5 class="card-title">{{$receita->titulo}}</h5>
                </div>
                <div class="col d-flex flex-column align-items-center justify-content-center">
                    <img src="{{ asset($receita->imagem) }}" class="imagem_receita" alt="{{$receita->titulo}}">
                </div>
                @endif
            </div>
        </div>
        <div class="col-2 d-flex flex-column align-items-center justify-content-center">
            <button type="button" class="btn btn-danger botao_excluir" data-bs-toggle="modal" data-bs-target="#modal_excluir_{{$receita->id}}">X</button>
        </div>
    </div>

    <div class="modal fade" id="modal{{$receita->id}}" tabindex="-1" aria-labelledby="modal{{$receita->id}}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{$receita->titulo}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe src="{{$receita->caminho_pdf}}" width="100%" height="600px"></iframe>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_excluir_{{$receita->id}}" tabindex="-1" aria-labelledby="modal_excluir_{{$receita->id}}" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Excluir {{$receita->titulo}}?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center justify-content-center">
                    <form action="{{ route('receita.excluir', ['id' => $receita->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal_excluir_{{$receita->id}}">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <div class="modal fade" id="modal_nova_receita" tabindex="-1" aria-labelledby="modal_nova_receita" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastrar nova receita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group m-2">
                        <div class="input-group empty-field">
                            <label for="inputGroupFile01" class="form-control"><span id="pdfFileName" class="file-name">Selecionar PDF</span></label>
                            <input type="file" class="form-control d-none" id="inputGroupFile01" accept=".pdf" onchange="displayFileName('pdfFileName', this)">
                            <label class="input-group-text d-none" for="inputGroupFile01" id="pdfUploadButton">Enviar</label>
                        </div>
                    </div>
                    <div class="form-group m-2">
                        <div class="input-group empty-field">
                            <label for="inputGroupFile02" class="form-control"><span id="imageFileName" class="file-name">Selecionar imagem</span></label>
                            <input type="file" class="form-control d-none" id="inputGroupFile02" accept=".jpg, .png, .jpeg" onchange="displayFileName('imageFileName', this)">
                            <label class="input-group-text d-none" for="inputGroupFile02" id="imageUploadButton">Enviar</label>
                        </div>
                    </div>
                    <div class="form-group m-2">
                        <div class="input-group empty-field">
                            <input type="text" class="form-control" id="titulo_receita" placeholder="Título da Receita">
                        </div>
                    </div>
                    <div class="form-group m-2" id="div_status_envio">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
        <script src="{{ asset('js/nova_receita.js') }}"></script>
        <script src="{{ asset('js/carregar_pdf.js') }}"></script>
        <script src="{{ asset('js/exibir_nome_arquivo_carregado.js') }}"></script>
        <script src="{{ asset('js/check_text_field.js') }}"></script>
        <script src="{{ asset('js/reload_apos_modal.js') }}"></script>

</body>

</html>