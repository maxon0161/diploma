<!DOCTYPE HTML>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title>ThGrCat - Отзывы</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <div class="page-header">
      <div class="container">
        <div class="header-top clearfix">
          <div class="header-logo">
            <img src="img/logo.png" alt="The Great Keksby" width="205" height="55">
          </div>
          <ul class="main-nav clearfix">
            <li><a href="index.html">Главная</a></li>
            <li><a href="catalog.html">Каталог</a></li>
            <li><a href="feedback.php">Отзывы</a></li>
          </ul>
          <a class="btn btn-quick-order" href=Create-feedback.php>Оставить отзыв</a>
        </div>
        <div class="promo">
          <a href="catalog.html">Аксессуары для котов<br> Коллекция Весна-Лето 2021</a>
        </div>
      </div>
    </div>
     <h2 class="section-title">Отзывы наших покупателей</h2>
  <?php
              require_once "connection.php"; 
                  $sql = "SELECT * FROM Feedbacks"; 
              
              if ($result = mysqli_query($link, $sql)) {
                if (mysqli_num_rows($result) > 0) {
                  echo "<table class='price-list'>";
                    echo "<thead>";
                      echo "<tr>
                          <th class='price-number'>№</th>;
                          <th>Кличка</th>
                          <th>Город</th>
                          <th>Отзыв</th>
                          </tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    while($row = mysqli_fetch_array($result)) {
                      echo "<tr>
                        <td>" . $row['ID'] . "</td>
                        <td class='price-name' >" . $row['Name'] . "</td>
                        <td class='price-master'>" . $row['City'] . "</td>
                        <td class='price-cost'>" . $row['Feedback'] . "</td>
                        </tr>";
                    }
                    echo "</tbody>";                            
                  echo "</table>";
                  mysqli_free_result($result); 
                } else {
                  echo "<p class='lead'><em>Записи не найдены</em></p>";
                }
              } else {
                echo "ОШИБКА: Не удалось выполнить запрос $sql. " . mysqli_error($link);
              } 
 ?>
</br></br>
    <div class="page-footer">
      <div class="container">
        <div class="footer-top clearfix">
          <div class="footer-logo">
            <img src="img/logo.png" alt="The Great Keksby" width="205" height="55">
          </div>
          <a href="Create-Zakaz.php" class="btn btn-quick-order">Заказать</a>
        </div>

        <div class="footer-bottom clearfix">
          <div class="footer-social">
            <b>Давайте дружить!</b>
            <a class="social-btn social-btn-vk" href="https://vk.com/stepushkin33">Вконтакте</a>
            <a class="social-btn social-btn-in" href="https://instagram.com/stepushkin_33">Инстаграм</a>
          </div>
          <div class="footer-copyright">
            С <span class="heart">любовью</span> для <a href="http://kitp.vlsu.ru/">КИТП ВлГУ</a>
          </div>
        </div>
      </div>
    </div>

  </body>
</html>