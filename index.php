<?php
    require ("link.php");
    require ("class.phpmailer.php");
    require ("class.smtp.php");

    /* Создаем запись в базе данных из запроса на странице */
    $insert = 'INSERT INTO `Task` (Name_ID, Task, Date, Complete) VALUES ("'.$_POST["select"].'", "'.$_POST["text"].'", "'.$_POST["date"].'", "false")';
    $res = mysqli_query ($link, $insert);


    /*Telegram Bot access token и URL.*/
    // $token = '511656971:AAFXyd6VYlVqRX0n_3eH-rIbj8XmoO-65yk';
    // $chat_id = '248608410';
    // $txt = $_POST["name"].", ".$_POST["date"]." тебе необходимо: ".$_POST["text"];
    // $fp=fopen("https://api.telegram.org/bot511656971:AAFXyd6VYlVqRX0n_3eH-rIbj8XmoO-65yk/sendMessage?chat_id={248608410}&parse_mode=html&text=hello,world","r");
    // $telegram = new Telegram(['botToken' => '511656971:AAFXyd6VYlVqRX0n_3eH-rIbj8XmoO-65yk',]);
    // $telegram -> sendMessage(['chat_id' => 'text' => '248608410', 'test',]);

    $mail = new PHPMailer ();

    $mail -> IsSMTP ();
    $mail -> Host = "smtp.gmail.com";
    $mail -> Port = 587;
    $mail -> SMTPSecure = 'tls';
    $mail -> SMTPAuth = true;
    $mail -> CharSet = "utf-8";
    $mail -> Username = "amelyakin@gmail.com";
    $mail -> Password = "123456";

    $mail -> SetFrom ("amelyakin@gmail.com");
    $mail -> AddAddress ("troyanda.rud@gmail.com");
    $mail -> Subject = "New task for you";
    $mail -> Body =
        "Ты должен до ".$_POST["date"]." выполнить следующее: \n".
        " ".$_POST["text"]."\n";

    if( $mail->send() )
    {
        echo 'Письмо отправлено';
    }
    else
    {
        echo 'Письмо не может быть отправлено. ';
        echo 'Ошибка: ' . $mail->ErrorInfo;
    }

    header('Location: index0.php'); //возврат на предыдущую страницу
    mysqli_close ($link); //закрытие базы данных
?>
