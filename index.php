<!DOCTYPE HTML>
<html>
<head>
    <title>Twittard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
        <h1>TWITTARD</h1>
        <a href="post.php"><button>Add an Article</button></a>
    </header>
    <section>
        <article>
            <h2>Title@author</h2>
            <h3>Category</h3>
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
                <textarea name="comentaire" >Enter a comment (100 characters max)</textarea>
                <button>Send</button>
            </form>      
        </article>
        <?php

        ?>
    </section>
</body>
</html>