<?php
session_start();
// Proteção de acesso
if (!isset($_SESSION['user_id']) || $_SESSION['user_perfil'] !== 'gestor') {
    header('Location: index.php');
    exit;
}

if (!isset($_GET['id'])) {
    die("ID do chamado não informado.");
}

$id = intval($_GET['id']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor - Detalhes do Chamado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">

<main class="container py-4">
    <nav class="mb-4">
        <a class="btn btn-outline-secondary" href="gestor_chamados.php">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
    </nav>

    <div class="row g-4">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-white">
                    <strong>Dados da Solicitação</strong>
                </div>
                <div id="detalhesChamado" class="card-body">
                    <div class="text-center">
                        <div class="spinner-border text-primary" role="status"></div>
                        <p>Carregando...</p>
                    </div>
                </div>
            </div>
            <div id="areaFechamento" class="mt-3"></div>
        </div>

        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <strong>Gerenciar Chamado</strong>
                </div>
                <div class="card-body">
                    <form id="formAtribuir">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Técnico responsável</label>
                            <select id="selectTecnico" class="form-select" required>
                                <option value="">Selecione...</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Prioridade</label>
                            <select id="prioridade" class="form-select" required>
                                <option value="baixa">Baixa</option>
                                <option value="media">Média</option>
                                <option value="alta">Alta</option>
                                <option value="urgente">Urgente</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Data prevista</label>
                            <input type="date" id="data_prevista" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Confirmar Atribuição
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="modalFoto" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center bg-dark">
                <img id="imgModal" class="img-fluid" src="">
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
const chamadoId = <?= $id ?>;
const modalElement = document.getElementById('modalFoto');
const bootstrapModal = new bootstrap.Modal(modalElement);

function verFoto(url) {
    document.getElementById('imgModal').src = url;
    bootstrapModal.show();
}

async function carregarDados() {
    try {
        // 1. Carregar Técnicos
        const resTec = await fetch('api/usuarios.php');
        if (!resTec.ok) throw new Error("Erro ao carregar técnicos da API.");
        
        const tecnicos = await resTec.json();
        const select = document.getElementById('selectTecnico');
        
        if (Array.isArray(tecnicos)) {
            tecnicos.forEach(t => {
                let option = document.createElement('option');
                option.value = t.id_usuario;
                option.textContent = t.nome;
                select.appendChild(option);
            });
        }

        // 2. Carregar Detalhes do Chamado
        const resChamado = await fetch(`api/chamado.php?id=${chamadoId}`);
        if (!resChamado.ok) throw new Error(`Erro na API de chamados: ${resChamado.status}`);
        
        const c = await resChamado.json();
        if(!c || c.error) throw new Error(c.error || "Chamado não encontrado");

        document.getElementById('detalhesChamado').innerHTML = `
            <p><strong>Status:</strong> <span class="badge bg-secondary">${(c.status || 'aberto').toUpperCase()}</span></p>
            <p><strong>Descrição:</strong> ${c.descricao_problema || 'Sem descrição'}</p>
            <p><strong>Local:</strong> ${c.bloco_nome || ''} - ${c.ambiente_nome || ''}</p>
            <p><strong>Solicitante:</strong> ${c.solicitante_nome || ''}</p>
            <p><strong>Abertura:</strong> ${c.data_abertura ? new Date(c.data_abertura).toLocaleString('pt-BR') : 'N/A'}</p>
            <div id="fotosContainer"></div>
        `;

        // Preencher form com dados atuais
        if (c.id_tecnico) select.value = c.id_tecnico;
        if (c.prioridade) document.getElementById('prioridade').value = c.prioridade;
        if (c.data_previsao_conclusao) document.getElementById('data_prevista').value = c.data_previsao_conclusao;

        // 3. Carregar Anexos
        const resAnexos = await fetch(`api/anexos.php?id_chamado=${chamadoId}`);
        if (resAnexos.ok) { // Só tenta processar os anexos se a API responder com sucesso
            const anexos = await resAnexos.json();
            if (Array.isArray(anexos) && anexos.length > 0) {
                let html = '<hr><h6>Evidências:</h6><div class="row">';
                anexos.forEach(arq => {
                    html += `
                        <div class="col-4 col-md-3 text-center mb-2">
                            <img src="${arq.caminho_arquivo}" class="img-fluid rounded border"
                                 style="cursor:pointer; height:100px; width:100%; object-fit:cover;"
                                 onclick="verFoto('${arq.caminho_arquivo}')">
                            <small class="text-muted d-block" style="font-size: 0.7rem">
                                ${arq.tipo_anexo === 'abertura' ? 'Abertura' : 'Conclusão'}
                            </small>
                        </div>
                    `;
                });
                document.getElementById('fotosContainer').innerHTML = html + '</div>';
            }
        }

    } catch (erro) {
        console.error(erro);
        document.getElementById('detalhesChamado').innerHTML =
            `<div class="alert alert-danger">Erro ao carregar dados do chamado: ${erro.message}</div>`;
    }
}

// Evento de envio do formulário
document.getElementById('formAtribuir').onsubmit = async (e) => {
    e.preventDefault();
    
    const dados = {
        id_chamado: chamadoId,
        id_tecnico: document.getElementById('selectTecnico').value,
        prioridade: document.getElementById('prioridade').value,
        data_prevista: document.getElementById('data_prevista').value
    };

    try {
        const res = await fetch('api/atribuir_chamado.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(dados)
        });

        if (!res.ok) throw new Error("Erro na requisição ao servidor.");

        const retorno = await res.json();
        if (retorno.success) {
            alert("Chamado atribuído com sucesso!");
            window.location.href = 'gestor_chamados.php';
        } else {
            alert("Erro: " + (retorno.message || "Falha ao atribuir."));
        }
    } catch (err) {
        alert("Erro de conexão com o servidor: " + err.message);
    }
};

carregarDados();
</script>

</body>
</html>