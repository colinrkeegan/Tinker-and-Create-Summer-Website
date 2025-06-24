<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="style.css">
    <style media="screen">
    @font-face {
        font-family: 'pokemon_blackwhiteregular';
        src: url('pokemon-black-white-webfont.woff2') format('woff2'),
        url('pokemon-black-white-webfont.woff') format('woff');
        font-weight: normal;
        font-style: normal;
    }

        #heroText {
            font-family: 'pokemon_blackwhiteregular';
            font-weight: lighter;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>



    <div id="hero">
        <div id="heroText">
            <span style='color:#E23514;'>Premier</span> Pokemon Rentals
            <br/>
            <p id="innerHeroText">Let us make your event <span style='color:#E23514;'>Premier!</span></p>
        </div>
    </div>

    <div class="section">
        <img  id="imageContainer" src="firstsection.jpg" alt="">

        <div id="fSecText">
            <p id="fHeader">Our Company</p>
            <p style='margin-right: 5px;'>Welcome to Premier Pokémon Rentals, based in the picturesque Sinnoh region! With a diverse arsenal of over 20 Pokémon to choose from, we cater to all your needs, whether it's for battling, companionship, special events like birthdays and weddings, or embarking on thrilling adventures.
            </p>
        </div>



    </div>


    <div class="section" id="secondSection">
        <div id="sSecText">
            <p id="fHeader">Our Collection</p>
            <p style='margin-left: 5px;'>Our collection includes Pokémon from Kanto, Hoenn, Johto, Sinnoh, and Unova regions, ensuring that you can find the perfect match for your specific requirements. Whether you're seeking a powerful ally for battle, a loyal companion to keep you company, or a majestic Pokémon to dazzle guests at your event, we have the Pokémon for you.
                <br><br>
                Browse our selection and embark on your next Pokémon journey with us!</p>

        </div>
        <img src="home2.jpeg" id="imageContainer" alt="">


    </div>




    <?php include 'footer.php'; ?>
</body>
</html>