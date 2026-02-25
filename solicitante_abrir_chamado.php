<?php
session_start();
if (!isset($_SESSION["user_id"]) || $_SESSION["user_perfil"] !== 'solicitante') {
    header("Location: login.php"); // Removido o espaço extra entre Location e :
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitante - Abrir Chamado</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
    <main id="chamado_soli" >
        <section id="cardCampos" >
            <div class="topo_soli">
                <h1>Abrir Chamado</h1>
                <a href="./solicitante_dashboard.php">Voltar</a>
            </div>
            <div class="conteudo_soli">
                <form id="formChamado">

                <div class="campoForm">
                    <label for="bloco">Bloco</label >
                    <select name="blocos" id="selectBloco" onchange="carregarAmbientes(this.value)" >
                        <option value=""></option>
                    </select>
                </div>
                    

                <div class="campoForm">
                    <label for="">Ambiente / Sala</label>
                    <select name="ambi" id="selectAmbiente">
                        <option value="">Selecione o ambiente primeiro...</option>
                    </select>
                </div>


                <div class="campoForm">
                    <label for="tipo">Tipo de serviço</label>
                    <select name="tipo" id="selectTipo">
                        <option value=""></option>
                    </select>
                </div>

                <div class="campoForm">
                    <label for="desc">Descrição do Problema</label>
                    <textarea name="" id="descricao"></textarea>
                </div>
                    
                    <div class="campoForm">
                        <label for="foto">Foto do ocorrido (opcional)</label>
                        <input type="file" id="foto" accept="" >
                    </div>

                    <button>Registrar Solicitação</button>
                </form>

            </div>
        </section>
    </main>

    <script>
        // Carrega Blocos e Tipos ao iniciar
        async function iniciar() {
            // Blocos
            const resB = await fetch('api/localizacoes.php?acao=listar_blocos');
            const blocos = await resB.json();
            const selB = document.getElementById('selectBloco');
            blocos.forEach(b => selB.innerHTML += `<option value="${b.id_bloco}">${b.nome}</option>`);

            // Tipos
            const resT = await fetch('api/localizacoes.php?acao=listar_tipos');
            const tipos = await resT.json();
            const selT = document.getElementById('selectTipo');
            tipos.forEach(t => selT.innerHTML += `<option value="${t.id_tipo}">${t.nome}</option>`);
        }

            // Carrega Ambientes dinamicamente quando o Bloco muda
            async function carregarAmbientes(id_bloco) {
                const selA = document.getElementById('selectAmbiente');
                if (!id_bloco) { selA.disabled = true; return; }
            
                const res = await fetch(`api/localizacoes.php?acao=listar_ambientes&id_bloco=${id_bloco}`);
                const ambientes = await res.json();
            
                selA.innerHTML = '<option value="">Selecione a Sala...</option>';
                ambientes.forEach(a => selA.innerHTML += `<option value="${a.id_ambiente}">${a.nome}</option>`);
                selA.disabled = false;
            }

    document.getElementById('formChamado').addEventListener('submit', async (e) => {
        e.preventDefault();
    
        const formData = new FormData();
        formData.append('id_ambiente', document.getElementById('selectAmbiente').value);
        formData.append('id_tipo', document.getElementById('selectTipo').value);
        formData.append('descricao', document.getElementById('descricao').value);
    
        const fotoFile = document.getElementById('foto').files[0];
        if (fotoFile) {
            formData.append('foto', fotoFile);
        }

        const response = await fetch('api/salvar_chamado.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();
        if (result.success) {
            alert(result.message);
            window.location.href = 'solicitante_dashboard.php';
        } else {
            alert("Erro: " + result.message);
        }
    });

            iniciar();
    </script>
</body>
</html>