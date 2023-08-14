<?php
  if(isset($_POST['country'])) {
    if ($_POST['country'] != NULL)
      $sql = mysqli_query($connection,"INSERT INTO countries (IDcountry, country) VALUES (NULL, '{$_POST['country']}');");
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
  } else
  
  if (isset($_GET['del'])) {
    $del = mysqli_query($connection, "DELETE FROM countries WHERE IDcountry = {$_GET['del']}");
    if ($del) {
      HTTPStatus(202);
      echo '<script>
        alert( "Страна успешно удалена из списка." );
      </script>';
    } else {
      HTTPStatus(400);
      echo '<script>
        alert( "Произошла ошибка. " );
      </script>';
    }
  }

  $result = mysqli_query($connection, "SELECT * FROM countries");
?>

<div id="center__block" class="position-relative overflow-hidden p-3 p-md-3 m-md-3 text-center bg-light">
  <div class="col-md-7 p-lg-7 mx-auto my-7">
    <h2 class="display-4 font-weight-normal">Список стран</h2>
  </div>
</div>

<div class="container marketing">
  <form action="" method="post">
    <div class="input-group mb-3">
      <input type="text" class="form-control" name="country" placeholder="Название страны" >
      <input type="submit" class="btn btn-primary" value="Добавить">
    </div>    
  </form>
  
  <table class="table table-striped">
    <?php
      while ($row = mysqli_fetch_row($result)){
        echo " <tr>
        <td> $row[1] </td>
        <td> 
          <a href='?del={$row[0]}'> Удалить </a>
        </td>
        </tr>";
      }
    ?>
  </table>
</div>