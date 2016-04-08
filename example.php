<!DOCTYPE HTML>
<html>
<head>
    <title>Source</title>
</head>
<body>
    <table>
        <?php
            $db = mysqli_connect("localhost","root","2Zz6500145","cinema") or die("no CNX");
            //$query = mysqli_query($db,"use cinema");
            $query2 = mysqli_query($db,'SELECT id,LOWER(titre) as titre,genre,pays,date,nb_copies FROM films ORDER BY titre');
            $i=0;
            echo'<table>';
            while ($result = mysqli_fetch_array($query2))
            {
                echo '<tr>';
                echo '<td>'.$result['id'].'</td>';
                echo '<td>'.$result['titre'].'</td>';
                echo '<td>'.$result['genre'].'</td>';
                echo '<td>'.$result['pays'].'</td>';
                echo '<td>'.$result['date'].'</td>';
                echo '<td>'.$result['nb_copies'].'</td>';
                //echo '<td>'.$result['art-essai'].'</td>';
                /*for ($i=0; $i < count($result); $i++) 
                { 
                    echo '<td>'.$result[''];
                }*/
                $i++;

            }
            echo '</table>';
            echo 'Nb of Movies = '.$i;
            //mysqli_free_result($query2);
            mysqli_close($db);natcasesort(array)
        ?>
    </table>
</body>
</html>