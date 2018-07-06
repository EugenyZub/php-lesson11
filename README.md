# php-lesson11

<h2>Соединение с БД:</h2> <br> 
$db = new PDO('mysql:host=localhost;dbname=filmoteka', 'root', '');

<h2>SQL запрос для получения данных из БД:</h2><br>
$sql = "SELECT * FROM `users` WHERE `name` = :username AND `password` = :password LIMIT 1";

<h2>SQL запрос для получения данных из БД(другой формат):</h2><br>
$sql = "SELECT * FROM `users` WHERE `name` = ? AND `password` = ? LIMIT 1";

<h2>Вывод записи из БД и запись их в ассоциативный массив(каждый последующий вызов
будет вызывать следующую запись):</h2> <br>
print_r( $result->fetch(PDO::FEETCH_ASSOC) ); 

<h2>Выбирает все данные из результата запроса и помещает их в массив:</h2> <br>
$films = $result->fetchAll(PDO::FETCH_ASSOC);

<h2>Связывает столбец с переменной PHP:</h2> <br>
$result->bindColumn('id', $id);

<h2>Экранирование символов, чтобы избежать SQL инъекций - в РУЧНОМ режиме:</h2> <br>
$username = $db->quote( $username );
$username = strtr($username, array('_' => '\_', '%' => '\%') );

<h2>Выборка с защитой от SQL инъекций - в АВТОМАТИЧЕСКОМ режиме:</h2><br>
$stmt->fetch();

<h2>Связывает параметр с заданным значением:</h2><br>
$stmt->bindValue(':username', $username);

<h2>Выполняет подготовленный запрос:</h2><br>
$stmt->execute();

<h2>Защита от ввода скриптов:</h2><br>
$username = htmlentities($username);

<h2>SQL запрос для вставки данных в БД:</h2><br>
$sql = "INSERT INTO `users` (name, email) VALUES (:name, :email)";

<h2>Вывод количества затронутых изменениями строк:</h2><br>
echo "<p>Было затронуто строк: " . $stmt->rowCount() . "</p>";

<h2>Получение ID:</h2><br>
echo "<p>ID вставленной записи: " . $db->lastInsertId() . "</p>";

<h2>SQL запрос для обновления данных в БД:</h2><br>
$sql ="UPDATE `users` SET `name` = :name, email = :email WHERE `id` = :id";

<h2>SQL запрос для удаления данных в БД:</h2><br>
$sql = "DELETE FROM `users` WHERE `name` = :name";





