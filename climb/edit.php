<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Climbing</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
    </head>
    <body>
        <div id="banner">
            <h1 id="title">Climbing Beta</h1>
        </div>
        <fieldset>
        <div id="page_wrap">
            <br>Hello, <?php echo $_SESSION['uname']; ?><a href="logout.php"><input type='submit' value='Logout' /><a href="main.php"><input type='submit' value='Main' /></a><br><br>
            <a href="display.php"><div class="button">On-sight</div></a>
            <a href="searchPage.php"><div class="button">Problem</div></a>
            <a href="main.php"><div class="button">View your posts</div></a><br><br>
            <br>
            <div id="form_wrap">
                <form action="updateDB.php" method="post">
                    <legend><b>Update</b></legend><br><br>
                    <div class="left">
                        <label>Type:</label>
                        <select name='type'>
                            <option value='1'>Location</option>
                            <option value='0'>Equipment</option>
                        </select><br><br>
                        <label>Title:</label><input type='text' name='title' value=<?php echo $_POST['ttl']; ?>><br><br>
                        <label>Description:</label><br>
                        <textarea rows="4" cols="50" name='description'><?php echo $_POST['desc']; ?></textarea><br><br>
                        <input type='hidden' name='ID' value="  <?php echo $_POST['ID']; ?>  ">
                    </div>
                    <input type='submit' value='Post' />
                </form>
            </div>
        <br><br>
    </fieldset>
    </body>
</html>