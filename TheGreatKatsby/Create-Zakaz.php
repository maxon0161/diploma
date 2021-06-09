<?php
  require_once "connection.php";
  $FIO = $Adress = $Phone = $Lot = $Comment = "";
  $FIO_error = $Adress_error = $Phone_error = $Lot_error = $Comment_error = "";
   
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Валидация
    $input_FIO = trim($_POST["FIO"]);
    if (empty($input_FIO)) {
      $FIO_error = "Пожалуйста, заполните поле.";
    } elseif (!filter_var($input_FIO, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[а-яА-Я тцушщхъфырэчсью]+$/")))) {
      $FIO_error = "Были введены недопустимые символы.";
    } else {
      $FIO = $input_FIO;
    }
        
    $input_Adress = trim($_POST["Adress"]);
    if(empty($input_Adress)) {
      $Adress_error = "Пожалуйста, заполните поле.";     
    } else{
      $Adress = $input_Adress;
    }

  $input_Phone = trim($_POST["Phone"]);
    if(empty($input_Phone)) {
      $Phone_error = "Пожалуйста, заполните поле.";     
    } elseif(!ctype_digit($input_Phone)){
      $Phone_error = "Значение должно быть числовым, без специальных символов.";
    } else{
      $Phone = $input_Phone;
    }

 $input_Lot = trim($_POST["Lot"]);
    if(empty($input_Lot)) {
      $Lot_error = "Пожалуйста, заполните поле.";     
    } else{
      $Lot = $input_Lot;
    }

    $input_Comment = trim($_POST["Comment"]);
    if(empty($input_Comment)) {
      $Comment_error = "Пожалуйста, заполните поле.";     
    } else{
      $Comment = $input_Comment;
    }

     //Проверка на наличие ошибок
    if (empty($FIO_error) && empty($Adress_error) && empty($Phone_error)  && empty($Lot_error)  && empty($Comment_error)) {
      // Подготовка INSERT запроса
      $sql = "INSERT INTO zakaz (FIO, Adress, Phone, Lot, Comment) VALUES ( ?, ?, ?, ?, ?)";
       
      if ($stmt = mysqli_prepare($link, $sql)) {
        // Привязка переменных к подготоваленному выражению в качестве параметров
        mysqli_stmt_bind_param($stmt, "ssiss", $param_FIO, $param_Adress, $param_Phone, $param_Lot, $param_Comment);
        
        // Установка параметров
        $param_FIO = $FIO;
        $param_Adress = $Adress;
        $param_Phone = $Phone;
        $param_Lot = $Lot;
        $param_Comment = $Comment;
        
        // Попытка выполнить запрос
        if (mysqli_stmt_execute($stmt)) {
          // Запись создана
          header("location: index.html");
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
    <title>ThGrCat - Сделать заказ</title>
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
        <h2 class="section-title">Заполните форму для отправки заказа</h2>
        <p class="feedback-tip"> Внимание! Оставление заказов с целью развлечения или частая отправка ложных данных по интересующим товарам карается прекращением сотрудничества и грустным пушистым другом у вас дома!</p>
        <form class="feedback-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <div class="feedback-form-group  <?php echo (!empty($FIO_error)) ? 'has-error' : ''; ?>">
            <label for="FIO">Ваша ФИО</label>
            <input type="text" name="FIO" value="<?php echo $FIO;?>">
            <span class="help-block"><?php echo $FIO_error;?></span>
          </div>
          <div class="clearfix">
            <div class="feedback-form-group feedback-form-group-left-part  <?php echo (!empty($Adress_error)) ? 'has-error' : ''; ?>">
              <label for="Adress">Ваш адрес (Куда осуществляется доставка)</label>
              <input type="text" name="Adress" value="<?php echo $Adress;?>">
              <span class="help-block"><?php echo $Adress_error;?></span>
            </div>
          </div>
          <div class="clearfix">
            <div class="feedback-form-group feedback-form-group-left-part  <?php echo (!empty($Phone_error)) ? 'has-error' : ''; ?>">
              <label for="Phone">Ваш номер телефона (Без "+")</label>
              <input type="text" name="Phone" value="<?php echo $Phone;?>">
              <span class="help-block"><?php echo $Phone_error;?></span>
            </div>
          </div>
          <div class="clearfix">
            <div class="feedback-form-group feedback-form-group <?php echo (!empty($Lot_error)) ? 'has-error' : ''; ?>">
              <label for="Lot">Товары, которые вы хотите приобрести (Название, количество)</label>
              <input type="text" name="Lot" value="<?php echo $Lot;?>">
              <span class="help-block"><?php echo $Lot_error;?></span>
            </div>
          </div>
          <div class="feedback-form-group  <?php echo (!empty($Comment_error)) ? 'has-error' : ''; ?>">
            <label for="Comment">Доп. комментарий к заказу:</label>
            <textarea name="Comment" value="<?php echo $Comment;?>"></textarea>
          </div>
          <input type="submit" class="btn" value="Отправить">
           <p>После отправки формы ваша заявка будет добавлена в нашу базу данных, после чего с вами свяжется оператор. Приятных покупок!</p>
        </form>
      </div>
    </div>

    <div class="page-footer">
      <div class="container">
        <div class="footer-top clearfix">
          <div class="footer-logo">
            <img src="img/logo.png" alt="The Great Keksby" width="205" height="55">
          </div>
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
