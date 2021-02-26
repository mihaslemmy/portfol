<?php

$userName = $_POST['userName'];
// $userEmail = $_POST['userEmail'];
$userPhone = $_POST['userPhone'];

// Load Composer's autoloader
require 'phpmailer/PHPMailer.php'; //стоял неправильный путь к этим файлам
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->CharSet = "utf-8"; //прописал кодировку русских символов, чтобы воспринимал корректно

//потом мы саму почту новаосозданную разрешили использовать этот скрипт весь
//и по сути больше ничего не делал, кроме как создание новой страницы для перехода после отправки


try {
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'mihaslemmy1987@gmail.com';                     // SMTP username
    $mail->Password   = 'hosterby1987';                               // SMTP password
    $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('mihaslemmy1987@gmail.com');
    $mail->addAddress('mihaslemmy1987@gmail.com');     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Новая заявка с сайта';
    $mail->Body    = "Имя пользователя: ${userName}, его телефон: ${userPhone}. Его почта: ${userEmail}";

    //в коде ниже идет проверка, если сообщение отправлено успешно, то переходи на страницу thanks, а если нет
    //то пиши ошибку "Ошибка отправки сообщения, повторите снова"

    if ($mail->send()) {
        header('Location: thanks.html');
    } else {
       alert("Ошибка отправки сообщения, повторите снова");
    }
    
    
} catch (Exception $e) {
    echo "Письмо не отправлено, есть ошибка. Код ошибки: {$mail->ErrorInfo}";
}