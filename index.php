<?php

// ВЫБОР ДАННЫХ ИЗ БД С ПОМОЩЬЮ КЛАССА "PDO"

//Соединение	
//$db = new PDO('mysql:host=localhost;dbname=filmoteka', 'root', '');
//$sql = "SELECT *FROM `films`";
//$result = $db->query($sql);
/*
echo "<h2>Вывод записей из результата по одной: </h2>";

while ( $film = $result->fetch(PDO::FETCH_ASSOC)  ) {
	//print_r($film);
	echo "Название фильма: " . $film['title'] . "<br>";
	echo "Жанр фильма: " . $film['genre'];
	echo "<br><br>";
}

//print_r( $result->fetch(PDO::FEETCH_ASSOC) ); //Вывод 1 записи из БД и запись их в ассоциативный массив(каждый последующий вызов будет вызывать следующую запись)

echo "<hr />";

$sql = "SELECT *FROM `films`";
$result = $db->query($sql);
$films = $result->fetchAll(PDO::FETCH_ASSOC);

echo "<h2>Выборка всех записей в массив и вывод на экран: </h2>";
foreach ($films as $film) {
	echo "Название фильма: " .$film['title'] . "<br>";
	echo "Жанр фильма: " .$film['genre'] . "<br>";
	echo "<br><br>";
}

echo "<hr />";

$sql = "SELECT *FROM `films`";
$result = $db->query($sql);

$result->bindColumn('id', $id);
$result->bindColumn('title', $title);
$result->bindColumn('genre', $genre);
$result->bindColumn('year', $year);

echo "<h2>Выборка всех записей в массив и вывод на экран: </h2>";
while ( $result->fetch(PDO::FETCH_ASSOC) ) {
	echo "ID: {$id} <br>";
	echo "Название: {$title} <br>";
	echo "Жанр: {$genre} <br>";
	echo "Год: {$year} <br>";
	echo "<br><br>";
}
*/




// ------------------- ВЫБОР ДАННЫХ ИЗ БД С ЗАЩИТОЙ  С ПОМЩЬЮ КЛАССА PDO ------------------
/*
// 1. Выборка данных без защиты от SQL инъекций
$db = new PDO('mysql:host=localhost;dbname=mini-site', 'root', '');
/*
$username = 'Joker';
$password = '555';

$sql = "SELECT * FROM `users` WHERE `name` ='{$username}' AND `password` = '{$password}' LIMIT 1";
$result = $db->query($sql);

echo "<h2>ции: </h2>";
//print_r( $result->fetch(PDO::FETCH_ASSOC) );

if ( $result->rowCount() == 1 ) {
	$user = $result->fetch(PDO::FETCH_ASSOC);
	echo "Имя пользователя: {$user['name']} <br>";
	echo "Email пользователя: {$user['email']} <br>";

}
*/

//2. Выборка с защитой от SQL инъекций - В РУЧНОМ режиме

/*
$username = 'Joker';
$password = '555';

$username = $db->quote( $username );
$username = strtr($username, array('_' => '\_', '%' => '\%') );

$password = $db->quote( $password );
$password = strtr($password, array('_' => '\_', '%' => '\%') );

$sql = "SELECT * FROM `users` WHERE `name` ='{$username}' AND `password` = '{$password}' LIMIT 1";

$result = $db->query($sql);

echo "<h2>Выборка записи с ручной защитой от SQL инъекции: </h2>";
//print_r( $result->fetch(PDO::FETCH_ASSOC) );

if ( $result->rowCount() == 1 ) {
	$user = $result->fetch(PDO::FETCH_ASSOC);
	echo "Имя пользователя: {$user['name']} <br>";
	echo "Email пользователя: {$user['email']} <br>";

}
*/





//3. Выборка с защитой от SQL инъекций - в АВТОМАТИЧЕСКОМ режиме
/*
$sql = "SELECT * FROM `users` WHERE `name` = :username AND `password` = :password LIMIT 1";
$stmt = $db->prepare($sql);

$username = 'Joker';
$password = '555';

$stmt->bindValue(':username', $username);
$stmt->bindValue(':password', $password);
$stmt->execute();

//Если не хотим для каждого значения вызывать метод bindValue то можно сразу в ->execute
//$stmt->execute(array(':username' => $usermname, ':password' => $password));

$stmt->bindColumn('name', $name);
$stmt->bindColumn('email', $email);

echo "<h2>Выборка записи с автоматической защитой от SQL инъекции: </h2>";
$stmt->fetch();
echo "Имя пользователя: {$user['name']} <br>";
echo "Email пользователя: {$user['email']} <br>";
*/



// 4. Выборка с защитой от SQL инъекии - в АВТОМАТИЧЕСКОМ режиме - ТОЛЬКО ДРУГОЙ ФОРМАТ ЗАПРОСА

/*
$sql = "SELECT * FROM `users` WHERE `name` = ? AND `password` = ? LIMIT 1";
$stmt = $db->prepare($sql);

$username = 'Joker';
$password = '555';

$username = htmlentities($username); //для защиты от ввода скриптов
$password = htmlentities($password);

$stmt->bindValue(1, $username);
$stmt->bindValue(2, $password);
$stmt->execute();


//Если не хотим для кадого значения вызывать метод bindValue то можно сразу в ->execute
//$stmt->execute( array( $usermname, $password) );

$stmt->bindColumn('name', $name);
$stmt->bindColumn('email', $email);

echo "<h2>Выборка записи с ручной автоматической защитой от SQL инъекции: </h2>";
$stmt->fetch();
echo "Имя пользователя: {$name} <br>";
echo "Email пользователя: {$email} <br>";

*/



// ----------------------- ВСТАВКА ДАННЫХ В БД --------------------------------
/*

$db = new PDO('mysql:host=localhost;dbname=mini-site', 'root', '');

//Запрос в БД
$sql = "INSERT INTO `users` (name, email) VALUES (:name, :email)";
$stmt = $db->prepare($sql);

$username = "Flash";
$useremail = "flash@gmail.com";

$stmt->bindValue(':name', $username);
$stmt->bindValue(':email', $useremail);
$stmt->execute();

echo "<p>Было затронуто строк: " . $stmt->rowCount() . "</p>";
echo "<p>ID вставленной записи: " . $db->lastInsertId() . "</p>";

*/

// ---------------------- ОБНОВЛЕНИЕ ЗАПИСЕЙ БД ------------------------------
/*
$db = new PDO('mysql:host=localhost;dbname=mini-site', 'root', '');

$sql ="UPDATE `users` SET `name` = :name, email = :email WHERE `id` = :id";

$stmt = $db->prepare($sql);

$username = "New Flash";
$useremail = "flash@inbox.com";
$id = '7';

$stmt->bindValue(':name', $username);
$stmt->bindValue(':email', $useremail);
$stmt->bindValue(':id', $id);
$stmt->execute();

echo "<p>Было затронуто строк: " . $stmt->rowCount() . "</p>";
*/


// -------------------- УДАЛЕНИЕ ДАННЫХ ИЗ БД -----------------------------
$db = new PDO('mysql:host=localhost;dbname=mini-site', 'root', '');

$sql = "DELETE FROM `users` WHERE `name` = :name";
$stmt = $db->prepare($sql);

$username = "New Flash";

$stmt->bindValue(':name', $username);
$stmt->execute();

echo "<p>Было затронуто строк: " . $stmt->rowCount() . "</p>";

?>