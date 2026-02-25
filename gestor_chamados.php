<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor Dashboard</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <nav>
            <section class="nav">
                <h1>SGM</h1>
                <div></div>
                <h1>Gestão Administrativa</h1>
            </section>
            <section class="nav">
                <h2>Olá, admin Gestor</h2>
                <div></div>
                <button type="button" class="btn btn-outline"><a href="./api/logout.php">Sair</a></button>
            </section>
        </nav>
    </header>
    <main>
        <section class="title" id="title_gestor" >
            <h3>Todos os chamados</h3>
            <div id="links">
                <div class="links" onclick="carregarChamados('')" style="cursor:pointer"><h6>Todos</h6></div>
                <div class="links" onclick="carregarChamados('aberto')" style="cursor:pointer"><h6>Abertos</h6></div>
                <div class="links" onclick="carregarChamados('em_execucao')" style="cursor:pointer"><h6>Em andamento</h6></div>
                <div class="links" onclick="carregarChamados('concluido')" style="cursor:pointer"><h6>Concluidos</h6></div>
            </div>
        </section>
        <section class="table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Solicitante</th> <th>Local</th>
                        <th>Prioridade</th> <th>Técnico</th> <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="tabelaGeral">
                    </tbody>
            </table>
        </section>
    </main>

    <div class="modal fade" id="modalFoto" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-0 text-center bg-dark">
                    <img src="" id="imgModal" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const coresPrioridade = { 'urgente': 'text-danger', 'alta': 'text-warning', 'media': 'text-primary', 'baixa': 'text-secondary' };
        const coresStatus = { 'aberto': 'bg-secondary', 'em_execucao': 'bg-warning', 'concluido': 'bg-success', 'fechado': 'bg-dark' };

        function verFoto(url) {
            document.getElementById('imgModal').src = url;
            new bootstrap.Modal(document.getElementById('modalFoto')).show();
        }

        async function carregarChamados(status = '') {
            const res = await fetch(`api/gestor_chamados.php?status=${status}`);
            const chamados = await res.json();
            const body = document.getElementById('tabelaGeral');

            body.innerHTML = chamados.map(c => `
                <tr>
                    <td>#${c.id_chamado}</td>
                    <td>${c.solicitante_nome}</td>
                    <td>
                        <small>${c.bloco_nome}</small><br>
                        <strong>${c.ambiente_nome}</strong>
                    </td>
                    <td><i class="bi bi-circle-fill ${coresPrioridade[c.prioridade]} me-1"></i> ${c.prioridade.toUpperCase()}</td>
                    <td>${c.tecnico_nome || '<em>Não atribuído</em>'}</td>
                    <td><span class="badge ${coresStatus[c.status]}">${c.status.replace('_', ' ').toUpperCase()}</span></td>
                    <td>
                        <a href="gestor_detalhes.php?id=${c.id_chamado}" class="btn btn-sm btn-primary">
                            <i class="fa-solid fa-gear"></i> Gerenciar
                        </a>
                    </td>
                </tr>
            `).join('');
        }

        // Inicializa a tabela
        carregarChamados();
    </script>
</body>
</html>