<?php

echo <<<_HTML_
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Hash</title>
</head>
<body>
    <br><br><br><br><br>
    <div align="center">
        <form method="post" action="$_SERVER[PHP_SELF]">
            <input type="radio" name="hashFunction" value="plainText" checked="true"> plain text<br>
            <input type="radio" name="hashFunction" value="md5"> md5 hash<br>
            <input type="radio" name="hashFunction" value="sha1"> sha1 hash<br>
            <input type="radio" name="hashFunction" value="bcrypt"> bcrypt(salt) hash<br>
            <input type="password" name="password"><br>
            <input type="submit">
        </form>
_HTML_;

if ("POST" == $_SERVER["REQUEST_METHOD"]) {
    if($_POST["hashFunction"] == "plainText"){
        echo "<p>input: ".$_POST["password"]."</p><br>";
        echo "<p>output: ".$_POST["password"]."</p><br>";
        echo "<p>It is like NAKED!</p><br>";
    }
    else if($_POST["hashFunction"] == "md5"){
        echo "<p>input: ".$_POST["password"]."</p><br>";
        echo "<p>output: ".md5($_POST["password"])."</p><br>";
        echo "<p>It may be easily<a href='https://hashtoolkit.com/decrypt-md5-hash/'>decrypted.</a></p><br>";
    }
    else if($_POST["hashFunction"] == "sha1"){
        echo "<p>input: ".$_POST["password"]."</p><br>";
        echo "<p>output: ".sha1($_POST["password"])."</p><br>";
        echo "<p>It may be easily<a href='https://hashtoolkit.com/decrypt-sha1-hash/'>decrypted.</a></p><br>";
    }
    else{
        $cost = 12;
        echo "<p>input: ".$_POST["password"]."</p><br>";
        echo "<p>output: ".password_hash($_POST["password"], PASSWORD_BCRYPT, ["cost" => $cost])."</p><br>";
        echo "<p>It is probably safe.</p><br>";
    }
}

echo <<<_HTML_
        <p><a href='https://hashtoolkit.com'>See More</a></p>
    </div>
</body>
</html>
_HTML_;
?>

<style>
    * {
        font-size: 105%;
        margin: 10px;
    }
</style>
