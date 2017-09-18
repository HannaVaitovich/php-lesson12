<?php

$host = 'localhost';    //127.0.0.1
$db = 'php-12-homework';
$user = 'root';
$password = "alex1983";


$pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $password);
/*$sql1 = "SELECT * FROM `books`";
$statement = $pdo->prepare($sql1);
$statement->execute();*/

//echo '<pre>';
//print_r($results);

/*foreach ($results as $row) {
    echo $row['id'] . ': ' . htmlspecialchars($row['name']) . '<br>';
}*/

 if(!empty($_GET)){
        $search_isbn = $_GET['isbn'];
        $search_name = $_GET['name'];
        $search_author = $_GET['author'];
    }

    if(!empty($search_isbn)){
        $select = "SELECT * FROM `books` WHERE `isbn` = '{$search_isbn}'";
    }elseif(!empty($search_name)){
        $select = "SELECT * FROM `books` WHERE `name` = '{$search_name}'";
    }elseif(!empty($search_author)){
        $select = "SELECT * FROM `books` WHERE `author` = '{$search_author}'";
    }
    else{
        $select = "SELECT * FROM `books`";
    }

$statement = $pdo->prepare($select);
$statement->execute();


$results = [];
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $results[] = $row;
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title>PHP: Lesson 12</title>
</head>
<body>
<style type="text/css">
* {
	box-sizing: border-box;
}
table {
	border-collapse: collapse;
	margin: 20px 0 0;
	padding: 0;
	background-color: #cccccc;
	font-family: sans-serif;
}
table tr td,
table tr th {
	border: 1px solid black;
	padding: 5px;
}
</style>
<h1>Библиотека успешного человека</h1>

<form method="GET" action="./index.php">
        <input type="text" name="isbn" placeholder="ISBN" value="">
        <input type="text" name="name" placeholder="Название книги" value="">
        <input type="text" name="author" placeholder="Автор книги" value="">
        <input type="submit" value="Поиск">
    </form>

<table>
	<tr>
		<th>Название</th>
		<th>Автор</th>
		<th>Год выпуска</th>
		<th>ISBN</th>
		<th>Жанр</th>
	</tr>
	<?php foreach ($results as $row) { ?>
	<tr>
    <td>
    	<?= $row['name']; ?>
    </td>
    <td>
    	<?= $row['author']; ?>
    </td>
    <td>
    	<?= $row['year']; ?>
    </td>
    <td>
    	<?= $row['isbn']; ?>
    </td>
    <td>
    	<?= $row['genre']; ?>
    </td>
	</tr>
	<?php } ?>
</table>

</body>
</html>