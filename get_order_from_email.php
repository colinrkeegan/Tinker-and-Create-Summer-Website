<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="create_order.css">
    <link rel="shortcut icon" href="favicon.ico">
    <style>
    @font-face {
        font-family: 'pokemon_blackwhiteregular';
        src: url('pokemon-black-white-webfont.woff2') format('woff2'),
        url('pokemon-black-white-webfont.woff') format('woff');
        font-weight: normal;
        font-style: normal;
    }

    .diagonal-div-bg {
        width: 99vw;
        max-width: 99vw;
        height: 150px;
        background-color: #1879B0;
        border: 6px double #0E598F;
        transform: skewX(-20deg);
        margin-left: -40px;
        position: relative;
        overflow: hidden;
        margin-bottom: 2px;
    }

    .diagonal-div {
        /* width: 350px;
        height: 50px; */
        width: 450px;
        height: 30px;
        background-color: #3EE1E0;
        border: 6px solid #2DB5C2;
        /* transform: skewX(-20deg); */
        margin-left: 0px;
        position: relative;
        overflow: hidden;
    }

    .content {
        transform: skewX(20deg);
        color: #595959;
        text-shadow: #000000 0.6px 0.6px 0.9px;
        padding-left: 30px;
        font-size: 30px;
        font-family: 'pokemon_blackwhiteregular';
        src: url('pokemon-black-white-webfont.woff2') format('woff2'),
        url('pokemon-black-white-webfont.woff') format('woff');
    }

    .diagonal-div-bg input {
        transform: skewX(20deg);
        /* color: #545854; */
        /* text-shadow: #000000 0.6px 0.6px 0.9px; */
        width: 430px;
        margin-left: 30px;
        margin-top: 2px;
        /* padding-left: 300px; */
        /* font-size: 30px; */
        font-family: 'pokemon_blackwhiteregular';
        src: url('pokemon-black-white-webfont.woff2') format('woff2'),
        url('pokemon-black-white-webfont.woff') format('woff');
        font-weight: normal;
        font-style: normal;
        font-size: 20px;
    }

    button {
        transform: skewX(20deg);
        color: #595959;
        width: 200px;
        text-shadow: #000000 0.6px 0.6px 0.9px;
        padding-left: 20px;
        font-size: 50px;
        background-color: #D7E0F7;
        border: 3px solid #0C517D;
        margin: 0 0 10px 50px;

        font-family: 'pokemon_blackwhiteregular';
        src: url('pokemon-black-white-webfont.woff2') format('woff2'),
        url('pokemon-black-white-webfont.woff') format('woff');
        font-weight: normal;
        font-style: normal;
    }

    .orders-div {
        font-family: Helvetica;
    }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <div id="eContain" style="margin-top:100px;">
        <div id="emailErrorMsg"></div>
        <form action="" method="post">
            <div class="diagonal-div-bg">
                <div class="diagonal-div">
                    <div class="content">
                        <label for="email">Enter Your Email:</label><br>
                    </div>
                </div>
                <input type="email" id="email" name="email" required><br><br>
                <button type="submit" id="submitbtn">Submit</button>
            </div>
        </form>


        <!-- <div class="diagonal-div-bg">
        <div class="diagonal-div">
        <div class="content">
        <label for="email">Email:</label>
    </div>
</div>
<input type="email" id="email" name="email" required>
</div> -->
</div>

<div style="margin-top: 20px;">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {

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
        $emailInput = $conn->real_escape_string($_POST['email']);
        $data = [];

        $query = "SELECT
        o.Email, o.OrderDate, o.CustomerFirstName, o.CustomerLastName,
        o.PokemonName, o.SpecialInstructions, o.Quantity, o.OrderID,
        p.Type1, p.Type2, p.Price, pc.Category, c.Description
        FROM Orders o
        JOIN Pokemon p ON o.PokemonName = p.Name
        LEFT JOIN Pokemon_Categories pc ON p.Name = pc.Name
        LEFT JOIN Categories c ON pc.Category = c.Category
        WHERE o.Email = ?;";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $emailInput);
        $stmt->execute();
        $result = $stmt->get_result();

        // if ($result) {
        //     echo "<script>console.log('OPTION1');</script>\n";
        // } elseif (!$result) {
        //     echo "<script>console.log('OPTION2');</script>\n";
        // } else {
        //     echo "<script>console.log('OPTION3');</script>\n";
        // }

        if (!($row = $result->fetch_assoc())) {
            echo "<script>console.log('EMAIL NOT FOUND!');</script>\n";
            // echo "<div class='diagonal-div-bg' style='width: 100vw; border-left-width: 15px; background-color: #E23514; border: 6px double #c22c10; top: 90px; height:auto; min-height:70px;'>";
            // echo "<div class='content'>";
            // echo "<p id='result' style='color: #ffffff; font-size: 50px; color: #ffffff; margin-bottom: 0px; margin-top: 10px; margin-left: 20px;'>We don't have any orders associated with that email!</p>";
            // echo "</div>";
            // echo "</div>";
            ?>
            <script>
                document.getElementById('emailErrorMsg').innerHTML = "<div class='diagonal-div-bg' style='width: 100vw; border-left-width: 15px; background-color: #E23514; border: 6px double #c22c10; margin-bottom:10px; height:auto; min-height:70px;'><div class='content'><p id='result' style='color: #ffffff; font-size: 50px; color: #ffffff; margin-bottom: 0px; margin-top: 10px; margin-left: 20px;'>We don't have any orders associated with that email!</p></div></div>";
            </script>
            <?php
        }




        while ($row = $result->fetch_assoc()) {
            echo "<script>console.log('BRUUUUUUH1');</script>";

            $email = $row['Email'];
            $orderID = $row['OrderID'];
            $pokemonName = $row['PokemonName'];

            if (!isset($data[$email])) {
                $data[$email] = [
                    'OrderDates' => [],
                    'Names' => [],
                    'Pokemons' => []
                ];
            } else {
                // echo "<script>console.log('BRUUUUU3');</script>\n";
            }

            if (!in_array($row['OrderDate'], $data[$email]['OrderDates'])) {
                $data[$email]['OrderDates'][] = $row['OrderDate'];
            } else {
                // echo "<script>console.log('BRUUUUUUH2');</script>\n";
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
            echo "<div class='orders-div' style='margin-bottom: 20px; padding: 10px; border: 1px solid #ccc; background-color: #1879B0; border: 6px double #0E598F; color: #ffffff'>";
            echo '<h2>Email: ' . htmlspecialchars($email) . '</h2>';
            echo '<strong>Order Dates:</strong> ' . implode(', ', $userInfo['OrderDates']) . '<br>';
            echo '<strong>Names:</strong> ' . implode(', ', $userInfo['Names']) . '<br>';

            echo '<h3>Pokemon Details:</h3>';
            foreach ($userInfo['Pokemons'] as $pokemonName => $pokemonInfo) {
                echo '<div style="padding-left: 20px; margin-top: 10px;">';
                echo '<strong>Pokemon Name:</strong> ' . htmlspecialchars($pokemonName) . '<br>';
                echo '<strong>Special Instructions:</strong> ' . implode('; ', $pokemonInfo['SpecialInstructions']) . '<br>';
                echo '<strong>Quantity:</strong> ' . implode(', ', $pokemonInfo['Quantity']) . '<br>';
                echo '<strong>Order ID:</strong> ' . htmlspecialchars($pokemonInfo['OrderID']) . '<br>';
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
    }
    ?>

    <?php include 'footer.php'; ?>
</body>
</html>