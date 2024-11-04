<?php
// Inicializa variáveis
$name = '';
$age = '';
$ticket_type = '';
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $age = (int)$_POST['age'];
    $ticket_type = $_POST['ticket_type'];
    $price = 0;

    // Mensagem de boas-vindas
    $message .= "Bem-vindo, $name!<br>";

    // Verifica a idade
    if ($age < 18) {
        $message .= "Ingresso não permitido para menores de idade.";
    } else {
        // Calcula o preço do ingresso
        switch ($ticket_type) {
            case "VIP":
                $price = 100;
                break;
            case "Regular":
                $price = 50;
                break;
            case "Básico":
                $price = 20;
                break;
        }
        $message .= "O preço do seu ingresso ($ticket_type) é R$ $price.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Ingressos</title>
    <link rel="stylesheet" href="style.css">
    
<body>
    <form action="index.php" method="post">
        <h1>SHOW DE ROCK 🎸</h1>
        <label for="name">Nome:</label>
        <input type="text" id="name" name="name" required value="<?php echo $name; ?>">

        <label for="age">Idade:</label>
        <input type="number" id="age" name="age" required value="<?php echo $age; ?>">

        <label for="ticket_type">Tipo de Ingresso:</label>
        <select id="ticket_type" name="ticket_type" required>
            <option value="VIP" <?php echo $ticket_type == 'VIP' ? 'selected' : ''; ?>>VIP</option>
            <option value="Regular" <?php echo $ticket_type == 'Regular' ? 'selected' : ''; ?>>Regular</option>
            <option value="Básico" <?php echo $ticket_type == 'Básico' ? 'selected' : ''; ?>>Básico</option>
        </select>

        <input type="submit" value="Enviar">
    </form>

    <?php
    // Exibe a mensagem de resultado se houver
    if ($message) {
        echo "<h2>Resultado:</h2>";
        echo $message;
    }
    ?>
</body>
</html>