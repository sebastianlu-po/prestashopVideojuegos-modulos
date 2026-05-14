
<?php 

    if (($gestor = fopen("catalogo.csv", "r")) !== FALSE) {

        fgetcsv($gestor);

        while (($producto = fgetcsv($gestor, 1000,   ",")) !== FALSE) {

            $nombre = $producto[0];
            $descripción = $producto[1];
            $precio = trim($producto[3]);
            $url_imagen = $producto[5];
            

            echo "<tr>
                    <td>$nombre</td>
                    <td>$precio €</td>
                    <td><img src=$url_imagen width='50'></td>
                  </tr>";
        }
        }

    fclose($gestor);
?>

