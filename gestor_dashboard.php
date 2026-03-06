<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor Dashboard</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
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
                <button type="button" class="btn btn-outline">
                    <a href="api/logout.php" onclick="return confirmarLogout()">Sair</a>
                </button>
            </section>
        </nav>
    </header>

    <main>
        <section class="card_section">
            <div class="card">
                <h3>Novas solicitações</h3>
                <h3>0</h3>
            </div>
            <div class="card">
                <h3>Em atendimento</h3>
                <h3>0</h3>
            </div>
            <div class="card">
                 <h3>Críticos / Urgente</h3>
                <h3>0</h3>
            </div>
        </section>

        <section class="bnt">        
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="height: 40px; width: 20%;">Gerenciar chamados</button>
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleBloco" style="height: 40px; width: 20%;">Gerenciar Blocos</button>
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleTipo" style="height: 40px; width: 20%;">Tipos de serviço</button>
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleUsu" style="height: 40px; width: 20%;">Gerenciar usuario</button>

            <div class="modal fade modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Gerenciar Ambientes</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="row g-3" id="formGerenciarAmbiente">
                                <div class="col-6">
                                    <label for="nome_ambiente">Nome do ambiente</label>
                                    <input type="text" class="form-control" id="nome_ambiente" placeholder="Ex: Sala 10" required>
                                </div>
                                <div class="col-6">
                                    <label for="id_bloco">ID do Bloco</label>
                                    <input type="number" class="form-control" id="id_bloco" placeholder="ID do bloco" required>
                                </div>
                                <div id="bnt_modal" class="col-12 mt-3">
                                    <button type="submit" class="btn btn-primary w-100">Salvar Ambiente</button>
                                </div>
                            </form>
                            <hr>
                            <div class="cards" id="lista-ambientes-corpo">
                                </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade modal-lg" id="exampleBloco" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">Gerenciar Blocos</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="row g-3">
                                <div class="col-6"><input type="text" class="form-control" placeholder="Nome do bloco"></div>
                                <div class="col-6"><input type="text" class="form-control" placeholder="Descrição"></div>
                                <div id="bnt_modal" class="col-12 mt-3">
                                    <button type="submit" class="btn btn-secondary w-100">Salvar Bloco</button>
                                </div>
                            </form>
                            <hr>
                            <div class="cards" id="lista-ambientes-corpo2"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade modal-lg" id="exampleTipo" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">Tipo de serviço</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="row g-3">
                                <div class="col-6"><input type="text" class="form-control" placeholder="Nome do serviço"></div>
                                <div class="col-6"><input type="text" class="form-control" placeholder="Descrição"></div>
                                <div id="bnt_modal" class="col-12 mt-3">
                                    <button type="submit" class="btn btn-primary w-100">Salvar Tipo de Serviço</button>
                                </div>
                            </form>
                            <hr>
                            <div class="cards" id="lista-ambientes-corpo3"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade modal-lg" id="exampleUsu" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">Gerenciar Usuarios</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="row g-3">
                                <div class="col-6"><input type="text" class="form-control" placeholder="Nome do Usuario"></div>
                                <div class="col-6"><input type="email" class="form-control" placeholder="Email do Usuario"></div>
                                <div class="col-6">
                                    <select class="form-select">
                                        <option selected>Perfil</option>
                                        <option value="1">Gestor</option>
                                        <option value="2">Solicitante</option>
                                        <option value="3">Tecnico</option>
                                    </select>
                                </div>
                                <div id="bnt_modal" class="col-12 mt-3">
                                    <button type="submit" class="btn btn-primary w-100">Salvar Usuario</button>
                                </div>
                            </form>
                            <hr>
                            <div class="cards" id="lista-ambientes-corpo4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        async function listarAmbientes() {
            const body = document.getElementById('lista-ambientes-corpo');
            try {
                const res = await fetch('api/api_ambientes.php');
                const resul = await res.json();
                if (resul.success) {
                    body.innerHTML = resul.data.map(item => `
                        <div class="card_list shadow-sm p-3 mb-2 bg-white rounded d-flex justify-content-between">
                            <div class="info">
                                <h2>${item.nome}</h2>
                                <p>${item.nome_bloco || ''}</p>
                            </div>
                            <div class="bnt_card">
                                <i class="bi bi-pencil-fill text-primary"></i>
                                <i class="bi bi-trash-fill text-danger"></i>
                            </div>
                        </div>
                    `).join('');
                }
            } catch (e) { body.innerHTML = "Erro ao carregar ambientes."; }
        }

        async function listarBlocos() {
            const body = document.getElementById('lista-ambientes-corpo2');
            try {
                const res = await fetch('api/api_blocos.php');
                const resul = await res.json();
                if (resul.success) {
                    body.innerHTML = resul.data.map(item => `
                        <div class="card_list shadow-sm p-3 mb-2 bg-white rounded d-flex justify-content-between">
                            <div class="info">
                                <h2>${item.nome}</h2>
                                <p>${item.descricao || ''}</p>
                            </div>
                            <div class="bnt_card">
                                <i class="bi bi-pencil-fill text-primary"></i>
                                <i class="bi bi-trash-fill text-danger"></i>
                            </div>
                        </div>
                    `).join('');
                }
            } catch (e) { body.innerHTML = "Erro ao carregar blocos."; }
        }

        async function listarTipos() {
            const body = document.getElementById('lista-ambientes-corpo3');
            try {
                const res = await fetch('api/api_tipo_servico.php');
                const resul = await res.json();
                if (resul.success) {
                    body.innerHTML = resul.data.map(item => `
                        <div class="card_list shadow-sm p-3 mb-2 bg-white rounded d-flex justify-content-between">
                            <div class="info">
                                <h2>${item.nome}</h2>
                                <p>${item.descricao || ''}</p>
                            </div>
                            <div class="bnt_card">
                                <i class="bi bi-pencil-fill text-primary"></i>
                                <i class="bi bi-trash-fill text-danger"></i>
                            </div>
                        </div>
                    `).join('');
                }
            } catch (e) { body.innerHTML = "Erro ao carregar tipos."; }
        }

        // Chamar as funções ao carregar a página
        window.onload = function() {
            listarAmbientes();
            listarBlocos();
            listarTipos();
        };
    </script>
</body>
</html>