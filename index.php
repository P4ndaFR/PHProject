<!DOCTYPE HTML>
<html>
<head>
    <title>Twittard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset='latin1' />
</head>
<body>
    <header>
        <h1>TWITTARD</h1>
        <a href="post.php"><button>Add an Article</button></a>
    </header>
    <section>
        <?php
            //if();
        ?>
        <article>
            <form method="post">
                <legend>Triez par :</legend>
                <input type="submit" name="likes" value="Likes">
                <input type="submit" name="dislikes" value="Dislikes">
                <input type="submit" name="chrono" value="Ordre chronologique">
                <input type="submit" name="nochrono" value="Ordre anti-chronologique">
                <input type="submit" name="category" value="Catégories">
            </form>
            <?php
                $qcontent='SELECT article.title AS atitle,article.content AS acontent,likes,dislikes,article.pseudo AS apseudo FROM article;';
                if($_POST['likes'])
                {
                    $qcontent='SELECT article.title AS atitle,article.content AS acontent,likes,dislikes,article.pseudo AS apseudo FROM article ORDER BY likes DESC;';
                }
                if($_POST['dislikes'])
                {
                    $qcontent='SELECT article.title AS atitle,article.content AS acontent,likes,dislikes,article.pseudo AS apseudo FROM article ORDER BY dislikes DESC;';
                }
                if($_POST['chrono'])
                {
                    $qcontent='SELECT article.title AS atitle,article.content AS acontent,likes,dislikes,article.pseudo AS apseudo FROM article ORDER BY postdate;';
                }
                if($_POST['nochrono'])
                {
                    $qcontent='SELECT article.title AS atitle,article.content AS acontent,likes,dislikes,article.pseudo AS apseudo FROM article ORDER BY postdate DESC;';
                }
                if($_POST['category'])
                {
                    $qcontent='SELECT article.title AS atitle,article.content AS acontent,likes,dislikes,article.pseudo AS apseudo,name FROM article,article_category WHERE article.title=article_category.title GROUP BY name,article_title;';
                }
            ?>
        </article>
        <?php
            $db = mysqli_connect("localhost","ark","azerty123","PHProject") or die("no connexion");
            mysqli_query($db,"SET NAMES UTF8");
            $q1 = mysqli_query($db,$qcontent);
            while ($raw = mysqli_fetch_array($q1))
            {
                echo '
                <article>
                    <h2>'.$raw['atitle'].'@'.$raw['apseudo'].'</h2>';
                    $q2 = mysqli_query($db,'SELECT name FROM article_category WHERE article_category.title=\''.$raw['atitle'].'\';');
                    while ($raw2 = mysqli_fetch_array($q2))
                    {
                        echo '<h3>'.$raw2['name'].'</h3>';
                    }
                    echo
                    '
                    <p>'.$raw['acontent'].'</p>';
                    $q3 = mysqli_query($db,'SELECT word FROM article_keyword WHERE article_keyword.title=\''.$raw['atitle'].'\';');
                    echo '<table>
                    <tr>';
                    while ($raw3 = mysqli_fetch_array($q3))
                    {
                        echo '<td><a id="key" href="">'.$raw3['word'].'</a></td>';
                    }
                    echo '</tr>
                    </table>
                    ';
                    $q= mysqli_query($db,'SELECT article_media.media_path AS amediapath,type FROM article_media,media WHERE article_media.title=\''.$raw['atitle'].'\' AND media.media_path=article_media.media_path;');
                    while($r = mysqli_fetch_array($q))
                    {
                        if($r['type'] == "picture")
                        {
                            echo '<img src="'.$r['amediapath'].'" alt="image" />';
                        }
                        if($r['type'] == "video")
                        {   
                            strtok($r['amediapath'],".");
                            $tok=strtok(".");
                            echo '
                            <video controls>
                            <source src="'.$r['amediapath'].'" type="video/'.$tok.'" >
                            </video>';
                        }
                    }
                    echo '
                    <form method="post">
                    <input id="like" type="submit" name="like'.$raw['atitle'].'" value="Like">
                    <input id="dislike" type="submit" name="dislike'.$raw['atitle'].'" value="Dislike">
                    </form>';
                    if($_POST['like'.$raw['atitle']])
                    {
                        mysqli_query($db,'UPDATE article SET likes=likes+1 WHERE article.title = \''.$raw['atitle'].'\';');
                    }
                    if($_POST['dislike'.$raw['atitle']])
                    {
                        mysqli_query($db,'UPDATE article SET dislikes=dislikes+1 WHERE article.title = \''.$raw['atitle'].'\';');
                    }
                    $q4 = mysqli_query($db,'SELECT name,content,pseudo FROM comment WHERE comment.title=\''.$raw['atitle'].'\';');
                    while ($raw4 = mysqli_fetch_array($q4)) 
                    {
                        echo '
                        <div id="comment">
                            <h2 id="comment">"'.$raw4['name'].'"@'.$raw4['pseudo'].'</h2>
                            <p id="comment">'.$raw4['content'].'</p>
                        </div>';   
                    }
                    echo'
                    <form method="POST" action="button">
                        <textarea name="comentaire" id="comment" placeholder="Enter a comment (100 characters max)"></textarea>
                        <br/><p id="form">Choose</p>
                        <input list="authors" name="authors">
                        <datalist id="authors">
                        ';
                                $q5 = mysqli_query($db,"select pseudo from user;");
                                while ( $raw5=mysqli_fetch_array($q5) )
                                {
                                    echo '<option value="'.$raw5['pseudo'].'">';
                                }
                        echo '
                        </datalist>
                        <p id="form">or create</p>
                        <textarea id="author" placeholder="an author"></textarea>
                        <button id="send" type="submit">Comment</button>
                    </form>      
                </article> ';
            }
        ?>
        <article>
            <h2>Title@author</h2>
            <h3>Category1</h3>
            <h3>Category2</h3>
            <h3>Category3</h3>
            <h3>Category4</h3>
            <h3>Category5</h3>
            <h3>Category6</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque interdum rutrum sodales. Nullam mattis fermentum libero, non volutpat.</p>
            <table>
                <tr>
                    <td><a id="key" href="">#keyword1</a></td>
                    <td><a id="key" href="">#keyword2</a></td>
                    <td><a id="key" href="">#keyword3</a></td>
                    <td><a id="key" href="">#keyword4</a></td>
                </tr>
            </table> 
            <img src="media/finda.jpg" alt="image" />
            <button id="like">Like</button>
            <button id ="dislike">Dislike</button>
            <form method="POST" action="button">
                <textarea name="comentaire" id="comment" >Enter a comment (100 characters max)</textarea>
                <br/><p id="form">Choose</p>
                <input list="authors" name="authors">
                <datalist id="authors">
                    <option value="author1">
                    <option value="author2">
                    <option value="author3">
                    <option value="author4">
                </datalist>
                <p id="form">or create</p>
                <textarea id="author">an author</textarea>
                <button id="send">Comment</button>
            </form>      
        </article>
    </section>
</body>
</html>