<?php
session_start();
// if (!isset($_SESSION['user_id'])) {
    // Redirecionar para a página de login ou fazer qualquer outra ação necessária
//     header("Location: login.php");
//     exit();
// }

include "conexao.php";
include "queriesSql.php";

try {
    $stmt = mysqli_prepare($conn, QUERY_SELECT_USER);
    mysqli_stmt_bind_param($stmt, "s", $_SESSION["user_id"]);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
} catch (Exception $e) {
    $e->getMessage();
    mysqli_rollback($conn);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil | Consulado Fitness</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
</head>

<body>
    <!-- menu de navegação  -->
    <nav class="navegacao">
        <div class="logo">
            <img src="../imagens/logo-mobile.png" alt="logo-mobile">
        </div>

        <div class="nav_desktop">
            <ul>
                <li class="nav"><a href="#" class="link">Treino</a></li>
                <li class="nav"><a href="#" class="link">Biblioteca</a></li>
                <li class="nav"><a href="#" class="link">Contato</a></li>
                <li class="nav"><a href="#" class="link">Perfil</a></li>
            </ul>
        </div>

        <div class="icon_menu">
            <button onclick="menuResponsivo()"><img class="icon_botao" src="../imagens/menu02.png" alt="menu"></button>
        </div>
    </nav>

    <div class="mobile">
        <ul>
            <li class="nav"><a href="#" class="link">Treino</a></li>
            <li class="nav"><a href="#" class="link">Biblioteca</a></li>
            <li class="nav"><a href="#" class="link">Contato</a></li>
            <li class="nav"><a href="#" class="link">Perfil</a></li>
        </ul>
    </div>
    <!-- fim do menu navegacao  -->

    <h1>Meu Perfil</h1>
    <div class="info">
        <div>
            <h2>Nome do usuário</h2>
            <p>emaildousuario@gmail.com</p>
        </div>
        <button><img src="" alt="">Editar</button>
    </div>

    <div class="info">
        <span>
            <h3>Informações Pessoais</h3>
            <button><img src="" alt="">Editar</button>
        </span>
        <div>
            <div class="info_linha">
                <div class="info_coluna">
                    <h2>Nível de Treino</h2>
                    <p>Intermediário</p>
                </div>
                <div class="info_coluna">
                    <h2>Preferência de Treino</h2>
                    <p>Musculação</p>
                </div>
            </div>
            <div class="info_linha">
                <div class="info_coluna">
                    <h2>Data de Nascimento</h2>
                    <p>17/05/2005</p>
                </div>
                <div class="info_coluna">
                    <h2>Sexo</h2>
                    <p>Masculino</p>
                </div>
                <div class="info_coluna">
                    <h2>Senha</h2>
                    <p>*******</p>
                </div>
            </div>
        </div>
    </div>

    <h2>Treino Atual</h2>
    <table border="1">
        <thead>
            <tr>
                <!-- <?php
                        // Gera automaticamente as colunas com base nas divisões presentes
                        if (isset($ficha_treino) && is_array($ficha_treino)) {
                            $fichaLength = count($ficha_treino["divisao"]);
                            switch ($fichaLength) {
                                case 1:
                                    echo "<th colspan='3'>Treino A - Full Body</th>";
                                    break;
                                case 2:
                                    echo "<th colspan='3'>Treino A - Superiores</th>";
                                    echo "<th colspan='3'>Treino B - Inferiores</th>";
                                    break;
                                case 3:
                                    echo "<th colspan='3'>Treino A - Peito, Ombros e Tríceps</th>";
                                    echo "<th colspan='3'>Treino B - Costas, Ombros e Bíceps</th>";
                                    echo "<th colspan='3'>Treino C - Pernas</th>";
                                    break;
                                case 4:
                                    echo "<th colspan='3'>Treino A - Peito e Tríceps</th>";
                                    echo "<th colspan='3'>Treino B - Costas e Bíceps</th>";
                                    echo "<th colspan='3'>Treino C - Pernas</th>";
                                    echo "<th colspan='3'>Treino D - Ombros</th>";
                                    break;
                                case 5:
                                    echo "<th colspan='3'>Treino A - Peito e Abdomen</th>";
                                    echo "<th colspan='3'>Treino B - Pernas</th>";
                                    echo "<th colspan='3'>Treino C - Costas e Abdomen</th>";
                                    echo "<th colspan='3'>Treino D - Ombros</th>";
                                    echo "<th colspan='3'>Treino E - Braços</th>";
                                    break;
                                default:
                                    echo "<th colspan='3'></th>";
                                    break;
                            }
                        } else {
                            echo "<div class='mensagemInicial'>";
                            echo "<h2>Você ainda não possui nenhum treino, preencha as informações e bora treinar!!</h2>";
                            echo "</div>";
                        }
                        ?> -->
            </tr>
            <tr>
                <!-- <?php
                        if (isset($ficha_treino) && is_array($ficha_treino)) {
                            // Obtemos o número total de divisões
                            $numDivisoes = count($ficha_treino["divisao"]);

                            // Repetir a estrutura do cabeçalho conforme o tamanho do array
                            for ($j = 0; $j < $numDivisoes; $j++) {
                                // Exibir as colunas do cabeçalho
                                echo "<th>Exercício</th>";
                                echo "<th>Série</th>";
                                echo "<th>Repetições</th>";
                            }
                        }
                        ?> -->
            </tr>
        </thead>
        <tbody>
            <!-- <?php
                    if (isset($ficha_treino) && is_array($ficha_treino)) {
                        // Encontrar o número máximo de exercícios em uma única divisão
                        $maxExercicios = 0;

                        foreach ($ficha_treino["divisao"] as $divisao => $exercicios) {
                            $numExercicios = count($exercicios);
                            if ($numExercicios > $maxExercicios) {
                                $maxExercicios = $numExercicios;
                            }
                        }

                        // Iterar sobre o número máximo de exercícios
                        for ($i = 0; $i < $maxExercicios; $i++) {
                            echo "<tr align='center'>";
                            foreach ($ficha_treino["divisao"] as $divisao => $exercicios) {
                                // Verificar se existe um exercício para o índice atual
                                if (isset($exercicios[$i])) {
                                    echo "<td>" . $exercicios[$i]["nome_exercicio"] . "</td>";
                                    echo "<td>" . $exercicios[$i]["serie"] . "</td>";
                                    echo "<td>" . $exercicios[$i]["repeticao"] . "</td>";
                                } else {
                                    // Se não houver exercício, exibir células vazias
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                }
                            }

                            echo "</tr>";
                        }
                    }
                    ?> -->
        </tbody>
    </table>
    <script src="../js/global.js"></script>
</body>

</html>