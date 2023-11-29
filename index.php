<?php
include __DIR__ .'/Model/hotels.php';
if (isset($_GET["parking"])) {
    $parking = $_GET['parking'];
    $hotels = array_filter($hotels, fn($item) => $parking === 'all' || $item['parking'] == $parking);
}
if (isset($_GET["vote"])) {
    $votes = $_GET['vote'];
    $hotels = array_filter($hotels, fn($item) => $votes === '' || $item['vote'] == $votes);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>PHP Hotel</title>
</head>
<body>

<!--HEADER: filter-->
<header class="container">
    <h1 class="text-center">PHP Hotel</h1>

        
<!--1 - Aggiungere un form ad inizio pagina che tramite una richiesta GET permetta di filtrare gli hotel che hanno un parcheggio.-->           
    <form action="index.php" method="GET">

        <!--parking-->
            <div>
                <p><strong>Parking </strong></p>
                <select  placeholder="parking" name="parking">
                        <option value="all">All</option>
                        <option value="0">Not available</option>
                        <option value="1">Available</option>
                </select>
                <button>Search</button>
            </div>

<!--2 - Aggiungere un secondo campo al form che permetta di filtrare gli hotel per voto-->
        <!--vote-->
            <div class="py-4">
                <p><strong> Vote </strong></p>
                    <input type="text" placeholder="Vote" name="vote">
                    <button>Search</button>
            </div>
               
    </form>
       
</header>

<!--MAIN: table-->
<main class="container">
    <?php if (count($hotels) > 0) { ?>
        
        <table class="table">

            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Descripton</th>
                    <th scope="col">Parking</th>
                    <th scope="col">Vote</th>
                    <th scope="col">Distance to center</th>
                </tr>
                </thead>

            <tbody>
            <?php foreach ($hotels as $item) { ?>
                <tr>
                    <td>
                        <?php echo $item["name"] ?>
                    </td>

                    <td>
                        <?php echo $item["description"] ?>
                    </td>

                    <td><?php if ($item['parking']) { ?>
                            <p><i class="fa-solid fa-check px-2"></i>Available</p>
                        <?php } else if (!$item['parking']) { ?>
                            <p><i class="fa-solid fa-xmark px-2"></i>Not available</p>
                        <?php } ?>
                    </td>
                    
                    <td>
                            <?php echo $item["vote"] ?>
                    </td>

                    <td>
                        <?php echo $item["distance_to_center"] ?>
                    </td>

                </tr>
            <?php } ?>
            </tbody>
        </table>
       
    <?php } ?>
</main>



    <footer class="container">

    </footer>

</body>
</html>