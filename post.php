<!DOCTYPE HTML>
<html>
<head>
    <title>Twittard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="script.js"></script>
</head>
<body>
    <header>
        <h1>TWITTARD</h1>
        <a href="index.php"><button>Back to the Wall</button></a>
    </header>
    <section>
        <?php
            $db = mysqli_connect("localhost","root","2Zz6500145","PHProject") or die("no connexion");
           
        ?>
        <article>
            <form method="post" id="form" enctype="multipart/form-data">
            <input id="title" name="title" placeholder="Entrer the Title">
            <p id='form'>@ and choose</p>
            <input list="authors" name="existant_author">
            <datalist id="authors">
                <?php
                $q1 = mysqli_query($db,"select pseudo from user;");
                while ( $raw1=mysqli_fetch_array($q1) )
                {
                    echo '<option value="'.$raw1['pseudo'].'">';
                }
            ?>
            </datalist>
            <p id='form'>or create</p>
            <input id="author" name="new_author" placeholder="an author">
            <!-- <textarea id="author">the Author</textarea> -->
            <?php
                $q1 = mysqli_query($db,"select name from category;");
                $nbcat=0;
                while ( $raw1=mysqli_fetch_array($q1) )
                {
                    echo '
                    <input type="hidden" name="MAX_FILE_SIZE" value="15 000 000" />
                    <input id="category" name="category'.$nbcat.'" type="checkbox">'.$raw1['name'].'</input>';
                    $tabcat[$nbcat]=$raw1['name'];
                    $nbcat++;
                    //echo $nbcat;
                }
            ?>
            <textarea id="content" name="content" placeholder="The Content(140 character max)"></textarea>
            <legend>Select a Keyword</legend>
            <?php
                $q1 = mysqli_query($db,"select word from keyword;");
                $nbkey=0;
                while ( $raw1=mysqli_fetch_array($q1) )
                {
                    echo '<input id="keyword'.$nbkey.'" name="existant_keyword" type="checkbox" value="'.$raw1['word'].'">'.$raw1['word'].'</input>';
                    $nbkey++;
                }
            ?>
            <legend>or add a new one</legend>
            <textarea id="keyword" name="new_keyword" placeholder="The Keyword(s)"></textarea>
            <legend>Enter a picture or a Video:</legend>
            <input type="file" name="media">
            <input  onclick="addInput()" type="button" value="Add another Picture/video" id='add' >
            <button id="post" type="submit">Post</button> 
            </form>     
        </article>
    </section>
    <?php
            echo $_POST['title'].'<br />';
            echo $_POST['existant_author'].'<br />';
            echo $_POST['new_author'].'<br />';
            for ($i=0; $i < $nbcat ; $i++)
            { 
                if(isset($_POST['category'.$i]))
                {
                    echo $tabcat[$i].' is checked!<br />';
                }
            }
            echo $_POST['existant_keyword'].'<br />';
            echo $_POST['new_keyword'].'<br />';
    ?>
</body>
</html>