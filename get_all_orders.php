<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get All Orders</title>
    <link rel="stylesheet" href="create_order.css">
    <link rel="shortcut icon" href="favicon.ico">
</head>
    <style>
        .all-orders-div {
            font-family: Helvetica;
        }
    </style>
<body>
<?php include 'header.php'; ?>
<div style="margin-top: 100px;"></div>
<?php

//Sets the username, server, password, database, and attempts to
//connect to the database
$server = "localhost";
$userid = "uml5cuvky5hoh";
$pw = "bingusdingus";
$db = "dbgg1vblaz4ceg";
$conn = new mysqli($server, $userid, $pw, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = [];
$query = "SELECT
            o.Email, o.OrderDate, o.CustomerFirstName, o.CustomerLastName,
            o.PokemonName, o.SpecialInstructions, o.Quantity, o.OrderID,
            p.Type1, p.Type2, p.Price, pc.Category, c.Description
          FROM Orders o
          JOIN Pokemon p ON o.PokemonName = p.Name
          LEFT JOIN Pokemon_Categories pc ON p.Name = pc.Name
          LEFT JOIN Categories c ON pc.Category = c.Category;";

$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    $email = $row['Email'];
    $pokemonName = $row['PokemonName'];

    if (!isset($data[$email])) {
        $data[$email] = [
            'OrderDates' => [],
            'Names' => [],
            'Pokemons' => []
        ];
    }

    if (!in_array($row['OrderDate'], $data[$email]['OrderDates'])) {
        $data[$email]['OrderDates'][] = $row['OrderDate'];
    }

    $fullName = $row['CustomerFirstName'] . ' ' . $row['CustomerLastName'];
    if (!in_array($fullName, $data[$email]['Names'])) {
        $data[$email]['Names'][] = $fullName;
    }

    if (!isset($data[$email]['Pokemons'][$pokemonName])) {
        $data[$email]['Pokemons'][$pokemonName] = [
            'SpecialInstructions' => [],
            'Quantity' => [],
            'OrderID' => $orderID,
            'OrderDate' => $row['OrderDate'],
            'Types' => [],
            'Categories' => [],
            'Price' => $row['Price']
        ];
    }

    if (!empty($row['SpecialInstructions']) && !in_array($row['SpecialInstructions'], $data[$email]['Pokemons'][$pokemonName]['SpecialInstructions'])) {
        $data[$email]['Pokemons'][$pokemonName]['SpecialInstructions'][] = $row['SpecialInstructions'];
    }

    if (!empty($row['Quantity']) && !in_array($row['Quantity'], $data[$email]['Pokemons'][$pokemonName]['Quantity'])) {
        $data[$email]['Pokemons'][$pokemonName]['Quantity'][] = $row['Quantity'];
    }

    if (!empty($row['Type1']) && !in_array($row['Type1'], $data[$email]['Pokemons'][$pokemonName]['Types'])) {
        $data[$email]['Pokemons'][$pokemonName]['Types'][] = $row['Type1'];
    }

    if (!empty($row['Type2']) && !in_array($row['Type2'], $data[$email]['Pokemons'][$pokemonName]['Types'])) {
        $data[$email]['Pokemons'][$pokemonName]['Types'][] = $row['Type2'];
    }

    if (!empty($row['Category'])) {
        $data[$email]['Pokemons'][$pokemonName]['Categories'][$row['Category']] = $row['Description'];
    }

}

$conn->close();

foreach ($data as $email => $userInfo) {
    echo "<div class='all-orders-div' style='margin-bottom: 20px; padding: 10px; border: 1px solid #ccc; background-color: #1879B0; border: 6px double #0E598F; color: #ffffff'>";
    echo '<h2>Email: ' . htmlspecialchars($email) . '</h2>';

    echo '<strong>Order Dates:</strong> ' . implode(', ', $userInfo['OrderDates']) . '<br>';
    echo '<strong>Names:</strong> ' . implode(', ', $userInfo['Names']) . '<br>';

    echo '<h3>Pokemon Details:</h3>';
    foreach ($userInfo['Pokemons'] as $pokemonName => $pokemonInfo) {
        echo '<div style="padding-left: 20px; margin-top: 10px;">';
        echo '<strong>Pokemon Name:</strong> ' . htmlspecialchars($pokemonName) . '<br>';
        echo '<strong>Special Instructions:</strong> ' . implode('; ', $pokemonInfo['SpecialInstructions']) . '<br>';
        echo '<strong>Quantity:</strong> ' . implode(', ', $pokemonInfo['Quantity']) . '<br>';
        // echo '<strong>Order ID:</strong> ' . htmlspecialchars($pokemonInfo['OrderID']) . '<br>';
        echo '<strong>Order Date:</strong> ' . htmlspecialchars($pokemonInfo['OrderDate']) . '<br>';
        echo '<strong>Price:</strong> $' . htmlspecialchars($pokemonInfo['Price']) . '<br>';

        echo '<strong>Types:</strong> ' . implode(', ', $pokemonInfo['Types']) . '<br>';
        echo '<strong>Categories:</strong> <ul>';
        foreach ($pokemonInfo['Categories'] as $category => $description) {
            echo '<li>' . htmlspecialchars($category) . ': ' . htmlspecialchars($description) . '</li>';
        }
        echo '</ul></div>';
    }
    echo '</div>';
}
?>

<?php include 'footer.php'; ?>
</body>
</html>