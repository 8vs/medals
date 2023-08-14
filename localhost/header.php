<?php
header("Access-Control-Allow-Methods: GET, POST"); 
function HTTPStatus($num) {
    $http = array(
        201 => 'HTTP/1.1 201 Created',
        202 => 'HTTP/1.1 202 Accepted',
        204 => 'HTTP/1.1 204 No Content',
        400 => 'HTTP/1.1 400 Bad Request',
        404 => 'HTTP/1.1 404 Not Found',
    );
 
    header($http[$num]);
 
    return
        array(
            'code' => $num,
            'error' => $http[$num],
        );
}
require 'db.php';

$categories = array(
	'Главная'    => 'index',
	'Страны'    => 'countries',
	'Медали' => 'medals',
	'Виды спорта'     => 'sports',
	'Спортсмены' => 'athletes'
);

?>

<nav class="site-header sticky-top py-1" id="my__head">
    <div class="container d-flex flex-column flex-md-row justify-content-between">
		<?php

		foreach ($categories as $name => $path) {
			echo "<a class=\"py-2 d-none d-md-inline-block\" href=\"$path.php\">$name</a>";
		}

		?>
    </div>
</nav>