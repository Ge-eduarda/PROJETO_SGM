<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor Dashboard</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
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
                
                <button type="button" class="btn btn-outline">
                    <a href="api/logout.php" onclick="return confirmarLogout()">Sair</a>

                    <script>
                        function confirmarLogout() {
                            return confirm("Você realmente deseja sair?");
                        }
                    </script>
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
            <a type="button" class="btn btn-secondary col-3" href="gestor_chamados.php">
                <i class="bi bi-clipboard-check"></i> Gerenciar Todos os Chamados
            </a>           

            <a type="button" class="btn btn-secondary col-3" href="" style="color: #000">
                <i class="bi bi-gear"></i> Configurar Ambiente
            </a>

        </section>
    </main>

    <script src="./assets/js/login.js"></script>
</body>
</html>