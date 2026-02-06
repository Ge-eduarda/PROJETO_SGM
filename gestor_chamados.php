<!DOCTYPE html>
<html lang="en">
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
                <div class="links"><h6>Todos</h6></div>
                <div class="links"><h6>Abertos</h6></div>
                <div class="links"><h6>Em andamento</h6></div>
                <div class="links"><h6>Concluidos</h6></div>
            </div>
        </section>
        <section class="table">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Foto</th>
                    <th>Local</th>
                    <th>Descrição</th>
                    <th>Data</th>
                    <th><div>Status</div></th>
                    <th>Ações</th>
                </tr>

                <tr>
                    <td>#1</th>
                    <td>Foto</th>
                    <td>Bloco Administrativo - Recepção</th>
                    <td>Vazando agua na lampada</th>
                    <td>Data</th>
                    <td>Fechada</th>
                    <td><div><i class="fa-solid fa-gear"></i>Gerenciar</div></td>
                </tr>

            </table>

        </section>
    </main>
</body>
</html>