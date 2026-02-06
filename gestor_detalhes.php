<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor Dashboard</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <header id="header_chamados">
        <a href="../gestor_dashboard">Voltar</a>
    </header>

    <main id="gestor"  >
        <section>
            <div class="section01">
                <div>
                    <h2>Dados da Solicitação</h2>
                </div>

                <div class="text">
                    <h4>Status:</h4>
                    <p>Fechado</p>
                </div>

                <div class="text">
                    <h4>Status:</h4>
                    <p>Fechado</p>
                </div>

                <div class="text">
                    <h4>Status:</h4>
                    <p>Fechado</p>
                </div>

                <div class="text">
                    <h4>Status:</h4>
                    <p>Fechado</p>
                </div>

                <div class="text">
                    <h4>Status:</h4>
                    <p>Fechado</p>
                </div>

                <div class="fotos">
                    <h3>Evidencias</h3>
                    <div class="fotos_midia">
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>
            <button type="submit">Reabir Chamado</button>

        </section>

        <section>
            <h2>Triagem e Atribuição</h2>
            <form action="">
                <label for="tecnico">Técnico Resposável</label>
                <select id="tecnico" name="tecnico">
                    <option value="sp">Tecnico (a) João</option>
                    <option value="rj">Técnico (a) Maria</option>
                    <option value="mg">Técnico (a) Kaio</option>
                </select>

                <label for="prioridade">Prioridade</label>
                <select id="prioridade" name="prioridade">
                    <option value="sp">Alta</option>
                    <option value="rj">Média</option>
                    <option value="mg">Baixa</option>
                </select>

                <label for="data">Data prevista</label>
                <input type="date" id="data" name="data">

                <button type="submit">Confirmar Atribuições</button>
            </form>
        </section>
    </main>
</body>
</html>
