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
            $db = mysqli_connect("localhost","root","2Zz6500145","PHProject") or die("no connexion");
            mysqli_query($db,"SET NAMES UTF8");
            $q1 = mysqli_query($db,'SELECT article.title AS atitle,article.content AS acontent,likes,dislikes,article.pseudo AS apseudo,media_path FROM article,media WHERE article.title=media.title;');
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
                    <img src="'.$raw['media_path'].'" alt="image" />
                    <button id="like">Like</button>
                    <button id ="dislike">Dislike</button>';
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
                        <br/><p id="instructions">Choose</p>
                        <input list="authors" name="authors">
                        <datalist id="authors">
                            <option value="author1">
                            <option value="author2">
                            <option value="author3">
                            <option value="author4">
                        </datalist>
                        <p id="instructions">or create</p>
                        <textarea id="author" placeholder="an author"></textarea>
                        <button id="send">Comment</button>
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
                <br/><p id="instructions">Choose</p>
                <input list="authors" name="authors">
                <datalist id="authors">
                    <option value="author1">
                    <option value="author2">
                    <option value="author3">
                    <option value="author4">
                </datalist>
                <p id="instructions">or create</p>
                <textarea id="author">an author</textarea>
                <button id="send">Comment</button>
            </form>      
        </article>
        <?php

        ?>
    </section>
</body>
</html>