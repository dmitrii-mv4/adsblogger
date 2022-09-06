<?php
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$phone = trim($_POST['phone']);
$telegram = trim($_POST['telegram']);



// указываем адрес отправителя, можно указать адрес на домене Вашего сайта
$fromMail = 'info@adsblogger.media';
$fromName = 'ADSBLOGGER.MEDIA';

// Сюда введите Ваш email
$emailTo = 'info@adsblogger.media';
$subject = 'ADSBLOGGER НОВАЯ ЗАЯВКА';
$subject = '=?utf-8?b?'. base64_encode($subject) .'?=';
$headers = "Content-type: text/plain; charset=\"utf-8\"\r\n";
$headers .= "From: ". $fromName ." <". $fromMail ."> \r\n";

// тело письма
$body = "Получено письмо с сайта ADSBLOGGER \nИмя: $name\nE-mail: $email\nТелефон: $phone\nTelegram: $telegram";

// сообщение будет отправлено в случае, если поле с номером телефона не пустое
if (strlen($phone) > 0) {
    $mail = mail($emailTo, $subject, $body, $headers, '-f'. $fromMail );
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Ваша заявка принята!</title>
</head>
<body>
<center><h1>Ваша заявка принята!</h1></center>
<center><h2>Мы свяжемся с вами в ближайшее время</h2></center>
<center><p>Вернуться <a href="/"> на главную страницу</a></p></center>


<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(89801783, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/89801783" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

</body>
</html>