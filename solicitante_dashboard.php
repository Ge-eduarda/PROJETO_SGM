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
            <button type="button" class="btn">Nova Solicitações</button>
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
                </tr>

                <tr>
                    <td>#1</th>
                    <td>Foto</th>
                    <td>Bloco Administrativo - Recepção</th>
                    <td>Vazando agua na lampada</th>
                    <td>Data</th>
                    <td>Fechada</th>
                </tr>

            </table>

        </section>
    </main>
</body>
</html>