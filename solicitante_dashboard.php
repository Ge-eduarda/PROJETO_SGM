<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

</head>
<body>
    <header  style="background-color: #2f3156ff;">
        <nav>
            <section class="nav">
                <h1>SGM</h1>
                <div></div>
                <h1>Painel do solicitante</h1>
            </section>
            <section class="nav">
                <h2>Olá, Maria Solicitante</h2>
                <div></div>
                <button type="button" class="btn btn-outline"><a href="./api/logout.php">Sair</a></button>
            </section>
        </nav>
    </header>
    <main>
        <section class="title">
            <h3>Minhas Solicitações</h3>
            <a type="button" class="btn" href="solicitante_abrir_chamado.php">Nova Solicitações</a>
        </section>
        <section class="table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Foto</th>
                        <th>Local</th>
                        <th>Descrição</th>
                        <th>Data</th>
                        <th><div>Status</div></th>
                    </tr>
                </thead>
                <tbody id="tabelaChamados">
                    
                </tbody>
                    
            </table>

        </section>
    </main>
    <script>
        function verFoto(url) {
            document.getElementById('imgModal').src = url;
            new bootstrap.Modal(document.getElementById('modalFoto')).show();
        }

        async function carregarChamados() {
            const chamados = await (await fetch('api/chamados.php')).json();
            const lista = document.getElementById('tabelaChamados');
            const cores = { 'aberto': 'bg-secondary', 'agendado': 'bg-info', 'em_execucao': 'bg-warning', 'concluido': 'bg-success', 'fechado': 'bg-dark' };

            lista.innerHTML = await Promise.all(chamados.map(async c => {
                // Busca se tem foto para mostrar miniatura na lista
                const anexos = await (await fetch(`api/anexos.php?id_chamado=${c.id_chamado}`)).json();
                const thumbHtml = anexos.length > 0 ?
                    `<img src="${anexos[0].caminho_arquivo}" class="mini-thumb" onclick="verFoto('${anexos[0].caminho_arquivo}')" style="width:40px;">` :
                    '<i class="bi bi-image text-muted"></i>';

                return `<tr>
                    <td>#${c.id_chamado}</td>
                    <td>${thumbHtml}</td>
                    <td>${c.bloco_nome} - ${c.ambiente_nome}</td>
                    <td>${c.descricao_problema.substring(0,30)}...</td>
                    <td>${new Date(c.data_abertura).toLocaleDateString()}</td>
                    <td><span class="badge ${cores[c.status]}">${c.status.toUpperCase()}</span></td>
                </tr>`;
            })).then(rows => rows.join(''));
        }
        carregarChamados();
    </script>
</body>
</html>