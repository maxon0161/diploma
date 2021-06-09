<?php
  require_once "connection.php";
  $Name = $City = $Feedback = "";
  $Name_error = $City_error = $Feedback_error = "";
   
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Валидация
    $input_Name = trim($_POST["Name"]);
    if (empty($input_Name)) {
      $Name_error = "Пожалуйста, заполните поле.";
    } elseif (!filter_var($input_Name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[а-яА-Я тцушщхъфырэчсью]+$/")))) {
      $Name_error = "Были введены недопустимые символы.";
    } else {
      $Name = $input_Name;
    }
        
    $input_City = trim($_POST["City"]);
    if(empty($input_City)) {
      $City_error = "Пожалуйста, заполните поле.";     
    } elseif (!filter_var($input_City, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[а-яА-Я тцушщхъфырэчсью]+$/")))) {
      $City_error = "Были введены недопустимые символы.";
    } else{
      $City = $input_City;
    }

   $input_Feedback = trim($_POST["Feedback"]);
    if(empty($input_Feedback)) {
      $Feedback_error = "Пожалуйста, заполните поле.";     
    } else{
      $Feedback = $input_Feedback;
    }


     //Проверка на наличие ошибок
    if (empty($Name_error) && empty($City_error) && empty($Feedback_error)) {
      // Подготовка INSERT запроса
      $sql = "INSERT INTO Feedbacks (Name, City, Feedback) VALUES ( ?, ?, ?)";
       
      if ($stmt = mysqli_prepare($link, $sql)) {
        // Привязка переменных к подготоваленному выражению в качестве параметров
        mysqli_stmt_bind_param($stmt, "sss", $param_Name, $param_City, $param_Feedback);
        
        // Установка параметров
        $param_Name = $Name;
        $param_City = $City;
        $param_Feedback = $Feedback;
        
        // Попытка выполнить запрос
        if (mysqli_stmt_execute($stmt)) {
          // Запись создана
          header("location: feedback.php");
          exit();
        } else {
          echo "Что-то пошло не так, попробуйте позже.";
        }
      }
       
      // Закрываем statement
      mysqli_stmt_close($stmt);
    } 
    // Закрываем соединение
  mysqli_close($link);
  }
  ?>
  
<!DOCTYPE HTML>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title>ThGrCat - Оставить отзыв</title>
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
        </div>
        <div class="promo">
          <a href="catalog.html">Аксессуары для котов<br> Коллекция Весна-Лето 2021</a>
        </div>
      </div>
    </div>


<div class="feedback">
      <div class="container">
        <h2 class="section-title">Отсавьте свой отзыв!</h2>
        <p class="feedback-tip">Будем рады обратной связи о качестве наших товаров и обсуживании :)</p>
        <form class="feedback-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <div class="feedback-form-group  <?php echo (!empty($Name_error)) ? 'has-error' : ''; ?>">
            <label for="Name">Имя питомца</label>
            <input type="text" name="Name" value="<?php echo $Name;?>">
            <span class="help-block"><?php echo $Name_error;?></span>
          </div>
          <div class="clearfix">
            <div class="feedback-form-group feedback-form-group-left-part  <?php echo (!empty($City_error)) ? 'has-error' : ''; ?>">
              <label for="City">Ваш город</label>
              <input type="text" name="City" value="<?php echo $City;?>">
              <span class="help-block"><?php echo $City_error;?></span>
            </div>
          </div>
          <div class="feedback-form-group  <?php echo (!empty($Feedback_error)) ? 'has-error' : ''; ?>">
            <label for="Feedback">Текст обращения:</label>
            <textarea name="Feedback" value="<?php echo $Feedback;?>"></textarea>
          </div>
          <input type="submit" class="btn" value="Отправить">
        </form>
      </div>
    </div>

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