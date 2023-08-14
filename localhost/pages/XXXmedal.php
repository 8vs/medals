<?php
  if (($_GET['status'] != '0') OR ($_GET['status'] == '2') OR ($_GET['status'] == '3')) {
    $result = mysqli_query($connection, "SELECT sports.sport , GROUP_CONCAT(athletes.FIO), colors.color 
      FROM athletes INNER JOIN medals ON medals.IDathlete=athletes.IDathlete 
      JOIN colors ON colors.IDcolor=medals.IDcolor 
      JOIN countries ON countries.IDcountry=medals.IDcountry 
      JOIN sports ON sports.IDsport=medals.IDsport WHERE colors.IDcolor={$_GET['status']} AND countries.country='{$_GET['id']}'
      GROUP BY medals.medals;");

    $medal = mysqli_fetch_row(mysqli_query($connection, "SELECT color FROM colors WHERE IDcolor= {$_GET['status']}"));
  }
  else if ($_GET['status'] == '0')
    $result = mysqli_query($connection, "SELECT sports.sport , GROUP_CONCAT(athletes.FIO), colors.color 
      FROM athletes INNER JOIN medals ON medals.IDathlete=athletes.IDathlete 
      JOIN colors ON colors.IDcolor=medals.IDcolor 
      JOIN countries ON countries.IDcountry=medals.IDcountry 
      JOIN sports ON sports.IDsport=medals.IDsport WHERE countries.country='{$_GET['id']}'
      GROUP BY medals.medals;");
  else
    HTTPStatus(204);
?>

<div id="center__block" class="position-relative overflow-hidden p-3 p-md-3 m-md-3 text-center bg-light">
    <div class="col-md-7 p-lg-7 mx-auto my-7">
        <h2 class="display-4 font-weight-normal"> Все медали <?= $medal[0];?> страны <?= $_GET['id'];?> </h2>
    </div>
</div>

<div class="container marketing" >
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Вид спорта</th>
        <th scope="col">Спортсмен</th>
        <th scope="col">Медаль</th>
      </tr>
    </thead>

      <?php
        while ($row = mysqli_fetch_row($result)){
          echo " <tr>
          <td> $row[0] </td>
          <td> $row[1] </td>
          <td> $row[2] </td>
          </tr>";
        } 
      ?>
  </table>
</div>



