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
            $db = mysqli_connect("localhost","ark","azerty123","PHProject") or die("no connexion");
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
                $q2 = mysqli_query($db,"select name from category;");
                $nbcat=0;
                while ( $raw2=mysqli_fetch_array($q2) )
                {
                    echo '
                    <input type="hidden" name="MAX_FILE_SIZE" value="15 000 000" />
                    <input id="category" name="category'.$nbcat.'" type="checkbox">'.$raw2['name'].'</input>';
                    $tabcat[$nbcat]=$raw2['name'];
                    $nbcat++;
                    //echo $nbcat;
                }
            ?>
            <textarea id="content" name="content" placeholder="The Content(140 character max)"></textarea>
            <legend>Select a Keyword</legend>
            <?php
                $q3 = mysqli_query($db,"select word from keyword;");
                $nbkey=0;
                while ( $raw3=mysqli_fetch_array($q3) )
                {
                    echo '<input name="keyword'.$nbkey.'" id="keyword" type="checkbox">'.$raw3['word'].'</input>';
                    $tabkey[$nbkey]=$raw3['word'];
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
            if( $_POST['new_author']!="" && $_POST['existant_author']!="" )
            {
                exit("You can only Choose/create 1 author");
            }
             if( $_POST['new_author']=="" && $_POST['existant_author']=="" )
            {
                exit("Select / Create a least 1 user");
            }

            $test=0;
            $q1 = mysqli_query($db,"select pseudo from user;");
            while ( $raw1=mysqli_fetch_array($q1) )
            {
                if($raw1['pseudo'] == $_POST['new_author'])
                {
                    exit("You can't create an existant user");
                }
            }
            if($_POST['new_author'] != "")
            {
                mysqli_query($db,'insert into user values("'.$_POST['new_author'].'")');
                mysqli_query($db,'insert into article values("'.$_POST['title'].'","'.$_POST['content'].'",0,0,"'.$_POST['new_author'].'");'); 
                echo "Nouvel auteur + article ok";
            }
            if($_POST['existant_author'] != "")
            {
                $q=mysqli_query($db,'insert into article values("'.$_POST['title'].'","'.$_POST['content'].'",0,0,"'.$_POST['existant_author'].'");');
                echo "Nouvel auteur + article ok";
            }
            for ($i=0; $i < $nbcat; $i++)
            { 
                if(isset($_POST['category'.$i]))
                {
                    $q=mysqli_query($db,'insert into article_category values("'.$_POST['title'].'","'.$tabcat[$i].'");');
                }
            }
            $q3 = mysqli_query($db,"select word from keyword;");
            $tok=strtok($_POST['new_keyword']," ");
            while ( $raw3=mysqli_fetch_array($q3) )
            {
                if($tok == $raw3['word'])
                {
                    exit("You can't enter an existing keyword");
                }
                $tok=strtok(" ");
            }
            for ($i=0; $i < $nbkey; $i++)
            {
                if(isset($_POST['keyword'.$i]))
                {
                    $q=mysqli_query($db,'insert into article_keyword values("'.$_POST['title'].'","'.$tabkey[$i].'");');
                }
            }
            $tok=strtok($_POST['new_keyword']," ");
            while ($tok !== false)
            {
                $q=mysqli_query($db,'insert into keyword values("'.$tok.'",0);');
                $q=mysqli_query($db,'insert into article_keyword values("'.$_POST['title'].'","'.$tok.'");');
                $tok=strtok(" ");
            }
    ?>
</body>
</html>