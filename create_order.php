<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="create_order.css">
    <link rel="shortcut icon" href="favicon.ico">
    <title>Order Form</title>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        let time = performance.now();
        let unique_id = time.toString();
        document.getElementById('orderID').value = unique_id;
    });
    </script>
</head>
<body>
    <?php include 'header.php'; ?>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

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

        $orderID = $_POST['orderID'];
        $quantity = $_POST['quantity'];
        $pokemonName = $_POST['pokemonName'];
        $specialInstructions = $_POST['specialInstructions'];
        $customerFirstName = $_POST['customerFirstName'];
        $customerLastName = $_POST['customerLastName'];
        date_default_timezone_set('America/New_York');
        $orderDate = date("Y-m-d");
        $email = $_POST['email'];

        $sql = "INSERT INTO Orders (OrderID, Quantity, PokemonName, SpecialInstructions, CustomerFirstName, CustomerLastName, OrderDate, Email) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("sissssss", $orderID, $quantity, $pokemonName, $specialInstructions, $customerFirstName, $customerLastName, $orderDate, $email);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                echo"<div class='diagonal-div-bg' style='width: 100vw; border-left-width: 15px; top: 90px;'>";
                echo"<div class='content'>";
                echo "<p id='result' style='color: #ffffff; font-size: 50px; color: #ffffff; margin-top: 0px; margin-bottom: 0px;'>Order successfully added!</p>";
            } else {
                echo"<div class='diagonal-div-bg' style='width: 100vw; border-left-width: 15px; background-color: #E23514; border: 6px double #c22c10; top: 90px; height:auto; min-height:70px;'>";
                echo"<div class='content'>";
                echo "<p id='result' style='color: #ffffff; font-size: 50px; color: #ffffff; margin-bottom: 0px; margin-top: 10px; margin-left: 20px;'>Whoops! Looks like you tried to order something we don't have!</p>";
            }
            $stmt->close();
        } else {
            echo"<div class='diagonal-div-bg' style='width: 100vw; border-left-width: 15px; background-color: #E23514; border: 6px double #c22c10; top: 90px;'>";
            echo"<div class='content'>";
            echo "<p id='result'style='color: #ffffff; font-size: 50px; color: #ffffff; margin-top: 0px; margin-bottom: 0px;'> Whoops! Your order failed.</p>";
        }
        echo"</div>";
        echo"</div>";
        $conn->close();
    }
    ?>
    <div id="body-wrap">
        <div id="form-container">
            <div class="diagonal-div-bg">
                <div class="diagonal-div-head-foot">
                    <div class="content-head-foot">
                        Place Your Order
                    </div>
                </div>
            </div>
            <form method="post">
                <input type="hidden" id="orderID" name="orderID">
                <div class="diagonal-div-bg">
                    <div class="diagonal-div">
                        <div class="content">
                            <label for="quantity">Quantity:</label>
                        </div>
                    </div>
                    <input type="number" id="quantity" name="quantity" required>
                </div>
                <div class="diagonal-div-bg">
                    <div class="diagonal-div">
                        <div class="content">
                            <label for="pokemonName">Pokemon Name:</label>
                        </div>
                    </div>
                    <select id="pokemonName" name="pokemonName" required>
                        <option value="">Choose a Pokemon!</option>
                        <option value="Arcanine">Arcanine</option>
                        <option value="Bayleef">Bayleef</option>
                        <option value="Chimchar">Chimchar</option>
                        <option value="Ditto">Ditto</option>
                        <option value="Emolga">Emolga</option>
                        <option value="Flygon">Flygon</option>
                        <option value="Gallade">Gallade</option>
                        <option value="Kingdra">Kingdra</option>
                        <option value="Mr. Mime">Mr. Mime</option>
                        <option value="Ninetales">Ninetales</option>
                        <option value="Plusle">Plusle</option>
                        <option value="Riolu">Riolu</option>
                        <option value="Samurott">Samurott</option>
                        <option value="Shedinja">Shedinja</option>
                        <option value="Skarmory">Skarmory</option>
                        <option value="Snorlax">Snorlax</option>
                        <option value="Togepi">Togepi</option>
                        <option value="Toxicroak">Toxicroak</option>
                        <option value="Tropius">Tropius</option>
                        <option value="Tyranitar">Tyranitar</option>
                        <option value="Umbreon">Umbreon</option>
                        <option value="Weavile">Weavile</option>
                    </select>
                    <!-- <input type="text" id="pokemonName" name="pokemonName" required> -->
                </div>
                <div class="diagonal-div-bg">
                    <div class="diagonal-div">
                        <div class="content">
                            <label for="customerFirstName">Customer First Name:</label>
                        </div>
                    </div>
                    <input type="text" id="customerFirstName" name="customerFirstName" required>
                </div>
                <div class="diagonal-div-bg">
                    <div class="diagonal-div">
                        <div class="content">
                            <label for="customerLastName">Customer Last Name:</label>
                        </div>
                    </div>
                    <input type="text" id="customerLastName" name="customerLastName" required>

                </div>
                <div class="diagonal-div-bg">
                    <div class="diagonal-div">
                        <div class="content">
                            <label for="email">Email:</label>
                        </div>
                    </div>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="diagonal-div-bg">
                    <div class="diagonal-div">
                        <div class="content">
                            <label for="specialInstructions">Special Instructions:</label>
                        </div>
                    </div>
                    <input type="text" id="specialInstructions" name="specialInstructions">
                </div>
                <div class="diagonal-div-bg">
                    <div class="diagonal-div-head-foot">
                        <div class="content-head-foot">
                            <button type="submit" id="submitbtn"><span>Submit Order</span></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- <div id="right-side-div">
        <img src="logo.png">
    </div> -->
</div>

<!-- <div class="diagonal-div-bg">
<div class="diagonal-div">
<div class="content">
TEST DIV
</div>
</div>
</div> -->



<?php include 'footer.php'; ?>
</body>
</html>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Order Form</title>
<script>
document.addEventListener("DOMContentLoaded", function() {
let time = performance.now();
let unique_id = 'order_' + time.toString().replace('.', '') + Math.floor(Math.random() * 10000);

document.getElementById('orderID').value = unique_id;
});
</script>
</head>
<body>
<h1>Place Order</h1>
<form method="post">
<input type="hidden" id="orderID" name="orderID">
<div>
<label for="quantity">Quantity:</label>
<input type="number" id="quantity" name="quantity" required>
</div>
<div>
<label for="pokemonName">Pokemon Name:</label>
<input type="text" id="pokemonName" name="pokemonName" required>
</div>
<div>
<label for="specialInstructions">Special Instructions:</label>
<input type="text" id="specialInstructions" name="specialInstructions">
</div>
<div>
<label for="customerFirstName">Customer First Name:</label>
<input type="text" id="customerFirstName" name="customerFirstName" required>
</div>
<div>
<label for="customerLastName">Customer Last Name:</label>
<input type="text" id="customerLastName" name="customerLastName" required>
</div>
<div>
<label for="email">Email:</label>
<input type="email" id="email" name="email" required>
</div>
<div>
<button type="submit">Submit Order</button>
</div>
</form>
</body>
</html>