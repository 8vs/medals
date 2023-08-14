<?php
  $sort_list = array(
    'numb_asc'   => 'gold DESC, silver DESC, bronze DESC',
    'numb_desc'  => 'numb DESC, gold, silver, bronze',
    'country_asc'  => 'country',
    'country_desc' => 'country DESC',
    'gold_asc'   => 'gold',
    'gold_desc'  => 'gold DESC',
    'silver_asc'   => 'silver',
    'silver_desc'  => 'silver DESC',
    'bronze_asc'   => 'bronze',
    'bronze_desc'  => 'bronze DESC',
    'all_asc'  => 'all_m',
    'all_desc' => 'all_m DESC',   
  );
 
  $sort_sql = $sort_list[$_GET['sort']] ?? reset($sort_list);

  $result = mysqli_query($connection, "SET @row_number = 0;");

  $result = mysqli_query($connection, "SELECT
    (@row_number := @row_number + 1) AS numb, 
    t.country,
    t.gold,
    t.silver,
    t.bronze,
    t.all_m
    FROM (
        SELECT
            countries.country AS country,
            (SELECT COUNT(*) FROM medals m WHERE m.IDcolor = 1 AND m.IDcountry = medals.IDcountry) AS gold,
            (SELECT COUNT(*) FROM medals m WHERE m.IDcolor = 2 AND m.IDcountry = medals.IDcountry) AS silver,
            (SELECT COUNT(*) FROM medals m WHERE m.IDcolor = 3 AND m.IDcountry = medals.IDcountry) AS bronze,
            (SELECT COUNT(*) FROM medals m WHERE m.IDcountry = medals.IDcountry) AS all_m,
            countries.IDcountry
        FROM
            medals
        JOIN countries ON countries.IDcountry = medals.IDcountry
        GROUP BY
            countries.country
        ORDER BY 
            gold DESC, silver DESC, bronze DESC
    ) AS t ORDER BY
            {$sort_sql};");

  function sort_link_th($title, $a, $b) {
	  $sort = $_GET['sort'];
 
    if ($sort == $a) {
      return '<a class="active" href="?sort=' . $b . '">' . $title . ' <i>(по убыванию)</i></a>';
    } elseif ($sort == $b) {
      return '<a class="active" href="?sort=' . $a . '">' . $title . ' <i>(по возрастанию)</i></a>';  
    } else {
      return '<a href="?sort=' . $a . '">' . $title . '</a>';  
    }
  }
?>

<div id="center__block" class="position-relative overflow-hidden p-1 p-md-1 m-md-1 text-center bg-light">
  <div class="col-md-5 p-lg-5 mx-auto my-5">
    <h2 class="display-4 font-weight-normal">Медальный зачет</h2>
    <p class="lead font-weight-normal">здесь вы сможете посмотреть рейтинги стран в медальном зачете</p>
  </div>
</div>

<div class="container marketing">
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th><?php echo sort_link_th('Место', 'numb_desc', 'numb_asc'); ?></th>
        <th><?php echo sort_link_th('Страна', 'country_desc', 'country_asc'); ?></th>
        <th><?php echo sort_link_th('Золото', 'gold_desc', 'gold_asc'); ?></th>
        <th><?php echo sort_link_th('Серебро', 'silver_desc', 'silver_asc'); ?></th>
        <th><?php echo sort_link_th('Бронза', 'bronze_desc', 'bronze_asc'); ?></th>
        <th><?php echo sort_link_th('Всего', 'all_desc', 'all_asc'); ?></th>
      </tr>
    </thead>
      <?php 
        while ($row = mysqli_fetch_row($result)){
          echo " <tr>
            <td> $row[0] </td>
            <td> $row[1] </td>
            <td> <a href=\"XXXmedals.php?id=".$row[1]."&status=1\">$row[2]</a> </td>
            <td> <a href=\"XXXmedals.php?id=".$row[1]."&status=2\">$row[3]</a> </td>
            <td> <a href=\"XXXmedals.php?id=".$row[1]."&status=3\">$row[4]</a> </td>
            <td> <a href=\"XXXmedals.php?id=".$row[1]."&status=0\">$row[5]</a> </td>
            </tr>";
        } 
      ?>
    </table>    
</div>