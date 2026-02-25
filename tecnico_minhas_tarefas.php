<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <header  style="background-color: #2f5637ff;">
        <nav>
            <section class="nav">
                <h1>SGM Técnico</h1>
                <div></div>
                <h1>João técnico</h1>
            </section>
            <section class="nav">
                <button type="button" class="btn btn-outline">
                    <a href="api/logout.php" onclick="return confirmarLogout()">Sair</a>

                    <script>
                        function confirmarLogout() {
                            return confirm("Você realmente deseja sair?");
                        }
                    </script>
                </button>            </section>
        </nav>
    </header>

    <main>
        <section class="title">
            <h3>Minha Fila de Trabalho</h3>
        </section>
        <section id="conteudo">
            <h5 class="text-success">
            <i class="bi bi-check-circle-fill me-2"></i>
            Nenhuma Tarefa Pendente!
            </h5>

        </section>
    </main>
</body>
</html>