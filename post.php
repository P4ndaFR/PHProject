<!DOCTYPE HTML>
<html>
<head>
    <title>Twittard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
        <h1>TWITTARD</h1>
        <a href="index.php"><button>Back to the Wall</button></a>
    </header>
    <section>
        <article>
            <form>
            <textarea id="title">Entrer the Title</textarea><p>@</p>
            <p id="instructions">and choose</p>
            <input list="authors" name="authors">
            <datalist id="authors">
                <option value="author1">
                <option value="author2">
                <option value="author3">
                <option value="author4">
            </datalist>
            <p id="instructions">or create</p>
            <textarea id="author">an author</textarea>
            <!-- <textarea id="author">the Author</textarea> -->
            <textarea id="category"> The Categorie(s)</textarea>
            <textarea id="content"> The Content(140 character max)</textarea>
            <textarea id="keyword">The Keyword(s)</textarea>
            <p id="image">Enter a picture or a Video:</p>
            <input type="file" name="image">
            <button id="post">Post</button> 
            </form>     
        </article>
        <?php

        ?>
    </section>
</body>
</html>