<?php
  if(isset($_POST['athlet']) AND isset($_POST['sport']) AND isset($_POST['medal']) AND isset($_POST['country']) ) {
    // HTTPStatus(201);
    $count = mysqli_fetch_row(mysqli_query($connection,"SELECT COUNT(IDmedal) FROM medals"));
    $medal = (int)$count[0]+1;

    if (($_POST['sport'] != NULL) AND ($_POST['medal'] != NULL) AND ($_POST['country'] != NULL)) {
      if ($_POST['athlet'] != NULL) {
        $sql = mysqli_fetch_row(mysqli_query($connection,"SELECT * FROM `medals` WHERE medals = $medal AND IDathlete = {$_POST['athlet']}"));
        if ($sql == 0)
          $sql = mysqli_query($connection,"INSERT INTO `medals` (`IDmedal`, `IDcolor`, `IDsport`, `IDathlete`, `IDcountry`, `medals`) 
            VALUES (NULL, '{$_POST['medal']}', '{$_POST['sport']}', '{$_POST['athlet']}', '{$_POST['country']}', '$medal')");

        if ($_POST['athlet1'] != NULL) {
          $sql1 = mysqli_fetch_row(mysqli_query($connection,"SELECT * FROM `medals` WHERE medals = $medal AND IDathlete = {$_POST['athlet1']}"));
          if ($sql1 == 0)
            $sql = mysqli_query($connection,"INSERT INTO `medals` (`IDmedal`, `IDcolor`, `IDsport`, `IDathlete`, `IDcountry`, `medals`) 
              VALUES (NULL, '{$_POST['medal']}', '{$_POST['sport']}', '{$_POST['athlet1']}', '{$_POST['country']}', '$medal')");
        }

        if ($_POST['athlet2'] != NULL) {
          $sql2 = mysqli_fetch_row(mysqli_query($connection,"SELECT * FROM `medals` WHERE medals = $medal AND IDathlete = {$_POST['athlet2']}"));
            if ($sql2==0)
              $sql = mysqli_query($connection,"INSERT INTO `medals` (`IDmedal`, `IDcolor`, `IDsport`, `IDathlete`, `IDcountry`, `medals`) 
                VALUES (NULL, '{$_POST['medal']}', '{$_POST['sport']}', '{$_POST['athlet2']}', '{$_POST['country']}', '$medal')");  
        }
        
        if ($_POST['athlet3'] != NULL) {
          $sql3 = mysqli_fetch_row(mysqli_query($connection,"SELECT * FROM `medals` WHERE medals = $medal AND IDathlete = {$_POST['athlet3']}"));
          if ($sql3==0)
            $sql = mysqli_query($connection,"INSERT INTO `medals` (`IDmedal`, `IDcolor`, `IDsport`, `IDathlete`, `IDcountry`, `medals`) 
              VALUES (NULL, '{$_POST['medal']}', '{$_POST['sport']}', '{$_POST['athlet3']}', '{$_POST['country']}', '$medal')");
        }

        if ($_POST['athlet4'] != NULL) {
          $sql4 = mysqli_fetch_row(mysqli_query($connection,"SELECT * FROM `medals` WHERE medals = $medal AND IDathlete = {$_POST['athlet4']}"));
          if ($sql4==0)
            $sql = mysqli_query($connection,"INSERT INTO `medals` (`IDmedal`, `IDcolor`, `IDsport`, `IDathlete`, `IDcountry`, `medals`) 
              VALUES (NULL, '{$_POST['medal']}', '{$_POST['sport']}', '{$_POST['athlet4']}', '{$_POST['country']}', '$medal')");
        }
      }

      if ($sql) {
        HTTPStatus(201);
        echo '<script>
          alert( "Данные успешно добавлены в таблицу." );
        </script>';
      } else {
        HTTPStatus(400);
        echo '<script>
          alert( "Произошла ошибка, проверьте правильность заполнения." );
        </script>';
      }
    }
  } else if (isset($_GET['del'])) {
    $del = mysqli_query($connection, "DELETE FROM medals WHERE medals = {$_GET['del']}");
    if ($del) {
      HTTPStatus(202);
      echo '<script>
        alert( "Медаль успешно удалена из списка." );
      </script>';
    } else {
      HTTPStatus(400);
      echo '<script>
        alert( "Произошла ошибка. " );
      </script>';
    }
  } 
    
  $result = mysqli_query($connection, "SELECT medals.medals, colors.color,sports.sport , GROUP_CONCAT(athletes.FIO), countries.country 
    FROM athletes INNER JOIN medals ON medals.IDathlete=athletes.IDathlete 
    JOIN colors ON colors.IDcolor=medals.IDcolor 
    JOIN countries ON countries.IDcountry=medals.IDcountry 
    JOIN sports ON sports.IDsport=medals.IDsport 
    GROUP BY medals.medals;");
  $medal = mysqli_query($connection, "SELECT * FROM colors");
  $country = mysqli_query($connection, "SELECT * FROM countries");
  $sport = mysqli_query($connection, "SELECT * FROM sports");
  
  $athlet = mysqli_query($connection, "SELECT * FROM athletes");
  $athlet1 = mysqli_query($connection, "SELECT * FROM athletes");
  $athlet2 = mysqli_query($connection, "SELECT * FROM athletes");
  $athlet3 = mysqli_query($connection, "SELECT * FROM athletes");
  $athlet4 = mysqli_query($connection, "SELECT * FROM athletes");

  function creat_select($title, $id, $sel) {
    echo '<div class="input-group mb-3">
      <input type="text" class="form-control" placeholder="'.$title.'" disabled>
        <select class="form-select" name="'.$id.'">
          <option selected disabled>Откройте это меню выбора</option>';
          while ($row = mysqli_fetch_row($sel)){
            echo ' <option value="'.$row[0].'">'.$row[1].'</option> ';
          } 
        echo "</select>
    </div> ";
  }
?>

<div id="center__block" class="position-relative overflow-hidden p-3 p-md-3 m-md-3 text-center bg-light">
    <div class="col-md-7 p-lg-7 mx-auto my-7">
        <h2 class="display-4 font-weight-normal">Список медалей</h2>
    </div>
</div>

<div class="container marketing" >
  <form action="" method="post">
    <?php 
      creat_select('Страна', 'medal', $medal); 
      creat_select('Страна', 'country', $country); 
      creat_select('Вид спорта', 'sport', $sport);
      creat_select('Спортсмен (обязательно)', 'athlet', $athlet);
      creat_select('Второй спортсмен (по желанию)', 'athlet2', $athlet2);
      creat_select('Третий спортсмен (по желанию)', 'athlet3', $athlet3);
      creat_select('Четвертый спортсмен (по желанию)', 'athlet4', $athlet4);
      creat_select('Пятый спортсмен (по желанию)', 'athlet1', $athlet1);
    ?>
    
    <input type="submit" class="btn btn-primary" value="Добавить">
  </form>

  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Медаль</th>
        <th scope="col">Вид спорта</th>
        <th scope="col">Спортсмен</th>
        <th scope="col">Страна</th>
        <th scope="col"> </th>
      </tr>
    </thead>

    <?php
      while ($row = mysqli_fetch_row($result)){
        echo " <tr>
        <td> $row[1] </td>
        <td> $row[2] </td>
        <td> $row[3] </td>
        <td> $row[4] </td>
        <td> 
          <a href='?del={$row[0]}'> Удалить </a>
        </td>
        </tr>";
      } 
    ?>
  </table>
</div>
