<?php
 
require_once('simplevk-master/autoload.php'); // БЛИБЛИОТЕКИ
require './vendor/autoload.php';// БЛИБЛИОТЕКИ
 
use Krugozor\Database\Mysql\Mysql as Mysql; // КЛАССЫ ДЛЯ РАБОТЫ С БД
use DigitalStar\vk_api\vk_api; // Основной класс
use DigitalStar\vk_api\Message; // Конструктор сообщений
use DigitalStar\vk_api\VkApiException; // Обработка ошибок

$host = 'localhost'; // По умолчанию localhost или ваш IP адрес сервера
$name = 'f0457801_maninmiddle'; // логин для авторизации к БД
$pass = '709397959'; // Пароль для авторизации к БД
$bdname = 'f0457801_maninmiddle'; // ИМЯ базы данных
$vk_key = 'e1f5dab6d6621d906341145775449de3beb2558a0e664bc318c08f915b320008a1f36e498c9337d429f4b'; // Длинный ключ сообщества, который мы получим чуть позже
$confirm = 'de4974c7'; // СТРОКА которую должен вернуть сервер
$v = '5.103'; // Версия API, последняя на сегодняшнее число, оставлять таким если на новых работать в будущем не будет
 
$db = Mysql::create($host, $name, $pass)->setDatabaseName($bdname)->setCharset('utf8mb4');
$vk = vk_api::create($vk_key, $v)->setConfirm($confirm);
$my_msg = new Message($vk);
$data = json_decode(file_get_contents('php://input')); //Получает и декодирует JSON пришедший из ВК
 
echo 'ok';
 
// ТУТ УЖЕ БУДЕМ ПИСАТЬ КОД //
 
// Переменные для удобной работы в будущем
$id = $data->object->message->from_id; // ИД того кто написал
$peer_id = $data->object->message->peer_id; // Только для бесед (ид беседы)
 
$time = time();
$cmd = explode(" ", mb_strtolower($data->object->message->text)); // Команды
$message = $data->object->message->text; // Сообщение полученное ботом
$new_ids = current($data->object->message->fwd_messages)->from_id ?? $data->object->message->reply_message->from_id; // ИД того чье сообщение переслали
$userinfo = $vk->userInfo($id);
$bonus = $vk->buttonText('⏰ Ежедневный Бонус', 'green', ['command' => 'bonus']);
$balans = $vk->buttonText('💸 Баланс','blue', ['command' => 'balans']);
$ecoin = $vk->buttonText('Перевод E Coin в EFM Coins', 'green', ['command' => 'ecoin']);
$magaz = $vk->buttonText('💰 Магазин', 'blue', ['command' => 'magaz']);
$gitara = $vk->buttonText('🎸 Гитара + 0.000001 E Coin ', 'white', ['command' => 'gitara']);
$skripka = $vk->buttonText('🎻 Скрипка + 0.000005 E Coin', 'blue', ['command' => 'skripka']);
$royal = $vk->buttonText('🎹 Рояль + 0.000010 E Coin', 'green', ['command' => 'royal']);
$prid = $vk->buttonText('🔥 Промокоды', 'red' , ['command' => 'prid']);
$nazad = $vk->buttonText('Назад 🎙 ','white',['command' => 'nazad']);
$ins = $vk->buttonText('Инструменты','blue',['command' => 'ins']);
$nabor = $vk->buttonText('👯‍♂ Хор + 0.000050 E Coin','red', ['command' => 'nabor']);
$truba = $vk->buttonText('🎺 Труба + 0.000250 E Coin', 'red', ['command' => 'truba']);
$kazik = $vk->buttonText('💴 Казино', 'blue', ['command' => 'kazik']);
$cases = $vk->buttonText('📦 Кейсы', 'green', ['command' => 'cases']);
$pokupka = $vk->buttonText('💳 Покупка кейсов', 'green', ['command' => 'pokupka']);
$igra = $vk->buttonText('Играть', 'green', ['command' => 'igra']);
$mini = $vk->buttonText('🕹 Мини-Игры', 'blue', ['command' => 'mini']);
$freecase = $vk->buttonText('🎁 Бесплатный кейс', 'blue', ['command' => 'freecase']);
$balik = $vk->buttonText('Выдать себе баланс', 'green', ['command' => 'balik']);
$evilcoin = $vk->buttonText('⚡ Evil Coin', 'green', ['command' => 'evilcoin']);
$info = $vk->buttonText('Информация', 'red', ['command' => 'info']);
$nomuro = $vk->buttonText('Nomuro Case - 999 EFM Coins', 'red', ['command' => 'nomuro']);
$eco = $vk->buttonText('Эконом Case - 350 EFM Coins', 'white', ['command' => 'eco']);
$steel = $vk->buttonText('Steel Case - 500 EFM Coins', 'green', ['command' => 'steel']);
$dop = $vk->buttonText('⚙ Дополнительно', 'red', ['command' => 'dop']);
$profile = $vk ->buttonText('🎗 Профиль', 'green', ['command' => 'profile']);
$helpme = $vk->buttonText('Помощь', 'green', ['command' => 'helpme']);
$help1 = $vk->buttonText('Я подавал заявку', 'green', ['command' => 'help1']);
$help2 = $vk->buttonText('Где заказать трек?', 'green', ['command' => 'help2']);
$help3 = $vk->buttonText('Как получить 100 рублей?', 'green', ['command' => 'help3']);
$press = $vk->buttonText('press', 'green' , ['command' => 'press']);
$wmoney = "100";
$vmoney = "110";
$amoney = '8500';
$fmoney = "91";
$rel = 1;
$null = 0;
$toors = "0.005000";
$treks = "Имеется";
$minsum = 1000;
$minvip = 500;
$vivod = $vk->buttonText('Вывод EFM Coins на ЛК - 1000 EFM Coins', 'green', ['command' => 'vivod']);
 
// Закончили с переменными
 
if ($id < 0){exit();} // ПРОВЕРЯЕМ что сообщение прислал юзер а не сообщество

if($message == 'Меню' or $message == 'меню') {
             $vk->sendButton($peer_id, "$userinfo[first_name], Вы попали в меню 👣",[[$profile],[$mini, $magaz],[$bonus],[$dop]]);
    }
    if (isset($data->object->message->payload)) {  //получаем payload
        $payload = json_decode($data->object->message->payload, True); // Декодируем кнопки в массив
    } else {
        $payload = null; // Если пришел пустой массив кнопок, то присваиваем кнопке NULL
    }
    $payload = $payload['command'];
   $promo = $id_reg_check = $db->query('SELECT promo FROM users WHERE vk_id = ?i', $id)->fetch_assoc()['promo'];
$balance = $db->query('SELECT balance FROM users WHERE vk_id = ?i', $id)->fetch_assoc()['balance']; // вытягиваем весь баланс
if($message == '#EFMLOVE' and $promo == 0) {
 $vk->sendMessage($peer_id, "Вы успешно активировали промокод. И получили 100 EFM Coins 🤑 ");
  $db->query('UPDATE users SET promo = ?i WHERE vk_id = ?i',$rel, $id);
  $db->query('UPDATE users SET balance = balance + ?i WHERE vk_id = ?i', $wmoney, $id); // Обновляем данные

  

}else{ 
    if($message == '#EFMLOVE' and $promo == 1) {
    $vk->sendMessage($peer_id, "Вы уже активировали промокод");
}
}



if($message == '212413') {
 $topik = $db->query('SELECT nick, evilcoin FROM `users` ORDER BY `users`.`evilcoin` DESC LIMIT 10')->fetch_assoc()['topik'];
 $vk->sendMessage($peer_id, "$topik");
}

    $id_reg_check = $db->query('SELECT vk_id FROM users WHERE vk_id = ?i', $id)->fetch_assoc()['vk_id']; // Пытаемся получить пользователя который написал сообщение боту
    if (!$id_reg_check and $id > 0) { // Если вдруг запрос вернул NULL (0) это FALSE, то используя знак ! перед переменной, все начинаем работать наоборот, FALSE становится TRUE
        // Так же мы проверяем что $id больше нуля, что бы не отвечать другим ботам, но лучше в самом верху добавить такую проверку что бы не делать лашних обращений к БД!
        $db->query("INSERT INTO users (vk_id, nick, status, time) VALUES (?i, '?s', ?i, ?i)", $id, "$userinfo[first_name] $userinfo[last_name]", 0, $time);


        $vk->sendButton($peer_id, "$userinfo[first_name], вы попали в главное меню Evolve FM", [[$profile],[$mini, $magaz],[$bonus],[$dop]]);
    }
    
 $promoc = $id_reg_check = $db->query('SELECT promoc FROM users WHERE vk_id = ?i', $id)->fetch_assoc()['promoc'];
$balance = $db->query('SELECT balance FROM users WHERE vk_id = ?i', $id)->fetch_assoc()['balance']; // вытягиваем весь баланс
if($message == 'q4PRgd' and $promoc == 0) {
 $vk->sendMessage($peer_id, "Вы успешно активировали бонусный промокод. И получили 110 EFM Coins 💰 ");
  $db->query('UPDATE users SET promoc = ?i WHERE vk_id = ?i',$rel, $id);
  $db->query('UPDATE users SET balance = balance + ?i WHERE vk_id = ?i', $vmoney, $id); // Обновляем данные

  

}else{ 
    if($message == 'q4PRgd' and $promoc == 1) {
    $vk->sendMessage($peer_id, "Вы уже активировали промокод");
}
}



 $fampromo = $id_reg_check = $db->query('SELECT fampromo FROM users WHERE vk_id = ?i', $id)->fetch_assoc()['fampromo'];
$balance = $db->query('SELECT balance FROM users WHERE vk_id = ?i', $id)->fetch_assoc()['balance']; // вытягиваем весь баланс
if($message == '#Evil' and $fampromo == 0) {
 $vk->sendMessage($peer_id, "Вы успешно активировали промокод семьи Evil Squad. И получили 91 EFM Coins 💰 ");
  $db->query('UPDATE users SET fampromo = ?i WHERE vk_id = ?i',$rel, $id);
  $db->query('UPDATE users SET balance = balance + ?i WHERE vk_id = ?i', $fmoney, $id); // Обновляем данные

  

}else{ 
    if($message == '#Evil' and $fampromo == 1) {
    $vk->sendMessage($peer_id, "Вы уже активировали семейный промокод.");
}
}

     

if($message == 'Админ' or $message == 'админ') {
            $status = $db->query('SELECT status FROM users WHERE vk_id = ?i', $id)->fetch_assoc()['status']; // вытягиваем статус
             if($status == 0) {
                  $vk->sendMessage($peer_id, 'Вы не администратор  ⛔  ');
             } else {
                 $vk->sendButton($peer_id, "$userinfo[first_name], вы попали в панель администратора. Перед выполнением каких любо действий, подумайте! ❗ ", [[$balik],[$beta],[$nazad]]);
             }
        }
 
    // Давайте для обработки кнопки воспльзуемся SWITCH - CASE
    switch ($payload) // Проще говоря мы загрузили кнопки кнопки в свич, теперь проверяем что за кнопка была нажата и обрабатываем ее
    {
         case 'bonus';
        $time_bonus = $id_reg_check = $db->query('SELECT time_bonus FROM users WHERE vk_id = ?i', $id)->fetch_assoc()['time_bonus'];
        if ($time_bonus < $time){
            //  + 21600 минут = 6 часов
            $next_bonus = $time + 86400; // Прибавляем 6 часов для следующего бонуса!
            $rand_money = mt_rand(10, 40); // Рандомно выбираем число от 100 до 5000, используя встроенную функцию PHP mt_rand
            $db->query('UPDATE users SET time_bonus = ?i, balance = balance + ?i WHERE vk_id = ?i',$next_bonus, $rand_money, $id); // Обновляем данные
            $vk->sendMessage($peer_id, "Вы взяли бонус, Вам выпало $rand_money EFM Coins");
        } else { // Иначе сообщим о том что бонус уже взят!

            $next_bonus = date("d.m в H:i:s",$time_bonus);
            $vk->sendMessage($peer_id,"Вы уже брали бонус ранее, следующий будет доступен \"$next_bonus\"");
        }

        break;
     



        case 'dop';
        $vk->sendButton($peer_id, "Вы попали в дополнительное меню", [[$prid],[$helpme],[$nazad]]);
        break;

        case 'balik';
         $status = $db->query('SELECT status FROM users WHERE vk_id = ?i', $id)->fetch_assoc()['status']; // вытягиваем статус
             if($status == 0) {
                  $vk->sendMessage($peer_id, 'Вы не администратор  ⛔  ');
             } else {
               $balance = $db->query('SELECT balance FROM users WHERE vk_id = ?i', $id)->fetch_assoc()['balance']; // вытягиваем весь баланс
               $db->query('UPDATE users SET balance = balance + ?i WHERE vk_id = ?i',  $amoney, $id);  
               $vk->sendButton($peer_id,'Вы выдали себе 8500 EFM Coins', [[$nazad]]);
             }
        break;
        
        case 'helpme';
      $vk->sendButton($peer_id,'Вы попали в меню помощи', [[$help1],[$help2],[$help3],[$nazad]]);
        break;
        
        case 'help1';
        $vk->sendMessage($peer_id,"$userinfo[first_name], ваша заявка рассматривается в порядке очереди.
Если же вы хотите ускорить процесс рассмотрения заявки отпишите HR-Менджеру, найти его можно в Контактах Группы.
С уважением, модератор EVOLVE FM", [$nazad]);
        break;
////////// cases //////////////////////////////////////////
        case 'cases';
        $vk->sendButton($peer_id,"$userinfo[first_name], Добро пожаловать в площадку кейсов 💫 ", [[$pokupka],[$freecase],[$info],[$nazad]]);
        break;
        
        case 'info';
        $vk->sendMessage($peer_id,"$userinfo[first_name], Существует 4 вида кейса:
        
            1.Бесплатный - данный кейс можно получить только если открыть платный, (первый раз доступен бесплатно)
            возможные призы:
                - 120 EFM Coins
                - 10 EFM Coins
            2.Эконом - данный кейс стоит 350 EFM Coins, возможные призы:
                - 670 EFM Coins
                - Статус 'Экономный Элита'
                - 20 EFM Coins
                
            3. Steel - данный кейс стоит 500 EFM Coins, возможные призы:
                - 1555 EFM Coins
                - Статус 'Король'
                - 100 EFM Coins
                
            4. Nomuro - данный кейс стоит 999 EFM Coins, возможные призы:
                - 7545 EFM Coins 
                - Статус 'Дьявол Кейсов'
                - VIP-Статус
                - 300 EFM Coins");
        break;
        
        case 'pokupka';
         $vk->sendButton($peer_id,"Выберите кейс", [[$eco], [$steel], [$nomuro],[$nazad]]);
        break;
        
        case 'eco';
        $sum = 350;
         $sum = 350;
         $trash = 20;
         $topchik = 670;
          $statu = "Экономный Элита";
         $balance = $db->query('SELECT balance FROM users WHERE vk_id = ?i', $id)->fetch_assoc()['balance']; // вытягиваем весь баланс

            if($balance < 350) {
                $vk->sendMessage($peer_id, "Кейс стоит 350 EFM Coins. А ваш баланс составляет $balance EFM Coins");
            } else {
            $vk->sendMessage($peer_id, "Вы успешно купили Экономный Case. Открываем...");
            $result = mt_rand(1, 4); // 1 - проиграл половину, 2 - победа x1.5, 3 - победа x2, 4 - проиграл все
            $win_money = ($result == 1 ? $balance + $trash - $sum   : ($result == 2 ? $balance + $trash - $sum  : ($result == 3 ? $balance + $trash - $sum : $balance + $topchik - $sum)));
            $win_nowin = ($result == 1 ? '20 EFM Coins' : ($result == 2 ? '20 EFM Coins' : ($result == 3 ? '20 EFM Coins' : '670 EFM Coins')));

            $vk->sendMessage($peer_id, "Ваш выигрыш $win_nowin ");
            $db->query('UPDATE users SET balance =  ?i WHERE vk_id = ?i',  $win_money, $id); // Обновляем данные
            $db->query('UPDATE users SET promocase = ?i WHERE vk_id = ?i',$null, $id);
            }
        break;
       case 'steel';
        $sum = 500;
         $sum = 500;
         $trash = 100;
         $topchik = 1555;
          $statu = "Король";
         $balance = $db->query('SELECT balance FROM users WHERE vk_id = ?i', $id)->fetch_assoc()['balance']; // вытягиваем весь баланс

            if($balance < 500) {
                $vk->sendMessage($peer_id, "Кейс стоит 500 EFM Coins. А ваш баланс составляет $balance EFM Coins");
            } else {
            $vk->sendMessage($peer_id, "Вы успешно купили Steel Case. Открываем...");
            $result = mt_rand(1, 4); // 1 - проиграл половину, 2 - победа x1.5, 3 - победа x2, 4 - проиграл все
            $win_money = ($result == 1 ? $balance + $trash - $sum   : ($result == 2 ? $balance + $trash - $sum  : ($result == 3 ? $balance + $trash - $sum : $balance + $topchik - $sum)));
            $win_nowin = ($result == 1 ? '100 EFM Coins' : ($result == 2 ? '100 EFM Coins' : ($result == 3 ? '100 EFM Coins' : '1555 EFM Coins')));

            $vk->sendMessage($peer_id, "Ваш выигрыш $win_nowin ");
            $db->query('UPDATE users SET balance =  ?i WHERE vk_id = ?i',  $win_money, $id); // Обновляем данные
            $db->query('UPDATE users SET promocase = ?i WHERE vk_id = ?i',$null, $id);
            }
        break;  
        case 'nomuro';
        $sum = 999;
         $sum = 999;
         $trash = 300;
         $topchik = 7545;
          $statu = "Дьявол Кейсов";
         $balance = $db->query('SELECT balance FROM users WHERE vk_id = ?i', $id)->fetch_assoc()['balance']; // вытягиваем весь баланс

            if($balance < 500) {
                $vk->sendMessage($peer_id, "Кейс стоит 500 EFM Coins. А ваш баланс составляет $balance EFM Coins");
            } else {
             $vk->sendMessage($peer_id, "Вы успешно купили Nomuro Case. Открываем...");
            $result = mt_rand(1, 4); // 1 - проиграл половину, 2 - победа x1.5, 3 - победа x2, 4 - проиграл все
            $win_money = ($result == 1 ? $balance + $trash - $sum   : ($result == 2 ? $balance + $trash - $sum  : ($result == 3 ? $balance + $trash - $sum : $balance + $topchik - $sum)));
            $win_nowin = ($result == 1 ? '300 EFM Coins' : ($result == 2 ? '300 EFM Coins' : ($result == 3 ? '300 EFM Coins' : '7545 EFM Coins')));

            $vk->sendMessage($peer_id, "Ваш выигрыш $win_nowin ");
            $db->query('UPDATE users SET balance =  ?i WHERE vk_id = ?i',  $win_money, $id); // Обновляем данные
            $db->query('UPDATE users SET promocase = ?i WHERE vk_id = ?i',$null, $id);
            }
        break;
        
        case 'freecase';
          $promocase = $id_reg_check = $db->query('SELECT promocase FROM users WHERE vk_id = ?i', $id)->fetch_assoc()['promocase'];
        if($promocase == 0) {
         $vk->sendMessage($peer_id, "Вы успешно купили бесплатный кейс. Открываем...");
        $trash = 10;
        $topchik = 120;
    $balance = $db->query('SELECT balance FROM users WHERE vk_id = ?i', $id)->fetch_assoc()['balance']; // вытягиваем весь баланс
    $result = mt_rand(1, 4); // 1 - проиграл половину, 2 - победа x1.5, 3 - победа x2, 4 - проиграл все
    $win_money = ($result == 1 ? $balance + $trash : ($result == 2 ? $balance + $trash : ($result == 3 ? $balance + $trash : $balance + $topchik)));
    $win_nowin = ($result == 1 ? '10 EFM Coins' : ($result == 2 ? '10 EFM Coins' : ($result == 3 ? '10 EFM Coins' : '120 EFM Coins')));
    $vk->sendMessage($peer_id, "Ваш выигрыш $win_nowin ");  
    $db->query('UPDATE users SET balance =  ?i WHERE vk_id = ?i',  $win_money, $id); // Обновляем данные
    $db->query('UPDATE users SET promocase = ?i WHERE vk_id = ?i',$rel, $id);
    
    }else{ 
        if($promocase == 1) {
        $vk->sendMessage($peer_id, "Вы уже получали бесплатный кейс. 
        Откройте любой платный и сможете снова открыть бесплатный кейс.");
    }
    }
        break;
 ////////// cases //////////////////////////////////////////////////// cases //////////////////////////////////////////      
        case 'help2';
        $vk->sendMessage($peer_id,"$userinfo[first_name], если вы хотите услышать любимую песню в эфире или передать привет - в игре слева в нижнем углу есть ник-нейм ведущего, пишите ему в СМС, с вашими предложениями. 
Если же Вы с другого сервера - всё там же в левом нижнем углу расположена ссылка на VK радиоведущего, напишите ему туда.
С уважением, EVOLVE FM", [$nazad]);
        break;
        
        case 'help3';
        $vk->sendMessage($peer_id,"$userinfo[first_name], чтобы получить заветные 100 рублей на личный кабинет Вы должны выиграть в еженедельной номинации на 3 призовых места, а именно: 
- Лайкер недели (Пролайкать больше всех постов за неделю) 
- Репостер недели (Сделать больше всех репостов за неделю) 
- Комментатор недели (Сделать больше всех интересных и содержательных комментариев к записям)
С уважением, EVOLVE FM", [$nazad]);
        break;
        
        case 'ins';
        $vk->sendButton($peer_id,"Вы попали в магазин инструментов", [[$gitara],[$skripka],[$royal],[$nabor],[$truba],[$nazad]]);
        break;
        
        case 'profile';
        $evilcoin = $db->query('SELECT evilcoin FROM users WHERE vk_id = ?i', $id)->fetch_assoc()['evilcoin'];
        $balance = $db->query('SELECT balance FROM users WHERE vk_id = ?i', $id)->fetch_assoc()['balance'];
        $nick = $db->query('SELECT nick FROM users WHERE vk_id = ?i', $id)->fetch_assoc()['nick'];
        $whois = $db->query('SELECT whois FROM users WHERE vk_id = ?i', $id)->fetch_assoc()['whois'];
        $vipka = $db->query('SELECT vipka FROM users WHERE vk_id = ?i', $id)->fetch_assoc()['vipka'];
        $vk->sendMessage($peer_id, "Ваш профиль
        
            👑 Ник: $nick.
            
           💰 Баланс: $balance EFM Coins.

           🔑 VIP: $vipka.

           👾 Ваш статус: $whois.
           
           ");
        break;
        
        case 'balans';
        $balance = $db->query('SELECT balance FROM users WHERE vk_id = ?i', $id)->fetch_assoc()['balance']; // вытягиваем весь баланс
        $vk->sendMessage($peer_id, "Ваш баланс: $balance EFM Coins");
        
        break;
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        case 'mini';
        $vk->sendButton($peer_id, "Вы попали в меню мини-игр 🕹", [[$kazik],[$cases],[$nazad]]);
    break;

        case 'gitara';
        $status = $db->query('SELECT status FROM users WHERE vk_id = ?i', $id)->fetch_assoc()['status']; // вытягиваем весь баланс
        $evilcoin = $db->query('SELECT evilcoin FROM users WHERE vk_id = ?i', $id)->fetch_assoc()['evilcoin']; // вытягиваем весь баланс
        if($evilcoin < 0.000040) {
            $vk->sendMessage($peer_id,"Гитара стоит 0.000050 E Coin ");
        } else {
            $db->query('UPDATE users SET evilcoin = evilcoin - 0.000050 WHERE vk_id = ?i', $id);  
            $db->query('UPDATE users SET coors = coors + 0.000001 WHERE vk_id = ?i', $id);  
            $vk->sendButton($peer_id,"Вы успешно купили гитару. С вашего баланса снято 0.000050 E Coin",[[$nazad]]);
        }
        break;
        // trade system //

        // trade system end //

        case 'nabor';
        $evilcoin = $db->query('SELECT evilcoin FROM users WHERE vk_id = ?i', $id)->fetch_assoc()['evilcoin']; // вытягиваем весь баланс
        if($evilcoin < 0.001500) {
            $vk->sendMessage($peer_id,"Стоимость хора 0.002000 E Coin ");
        } else {
            $db->query('UPDATE users SET evilcoin = evilcoin - 0.002000 WHERE vk_id = ?i', $id);  
            $db->query('UPDATE users SET coors = coors + 0.000050 WHERE vk_id = ?i', $id);  
            $vk->sendButton($peer_id,"Вы успешно купили Хор. С вашего баланса снято 0.002000 E Coin",[[$nazad]]);
        }
        break;
        
        case 'royal';
        $evilcoin = $db->query('SELECT evilcoin FROM users WHERE vk_id = ?i', $id)->fetch_assoc()['evilcoin']; // вытягиваем весь баланс
        if($evilcoin < 0.001250) {
            $vk->sendMessage($peer_id,"Рояль стоит 0.001250 E Coin ");
        } else {
            $db->query('UPDATE users SET evilcoin = evilcoin - 0.001250 WHERE vk_id = ?i', $id);  
            $db->query('UPDATE users SET coors = coors + 0.000010 WHERE vk_id = ?i', $id);  
            $vk->sendButton($peer_id,"Вы успешно купили рояль. С вашего баланса снято 0.001250 E Coin",[[$nazad]]);
        }
        break;
        case 'skripka';
        $evilcoin = $db->query('SELECT evilcoin FROM users WHERE vk_id = ?i', $id)->fetch_assoc()['evilcoin']; // вытягиваем весь баланс
        if($evilcoin < 0.000350) {
            $vk->sendMessage($peer_id,"Скрипка стоит 0.000350 E Coin ");
        } else {
            $db->query('UPDATE users SET evilcoin = evilcoin - 0.000350 WHERE vk_id = ?i', $id);  
            $db->query('UPDATE users SET coors = coors + 0.000005 WHERE vk_id = ?i', $id);  
            $vk->sendButton($peer_id,"Вы успешно купили скрипку. С вашего баланса снято 0.000350 E Coin",[[$nazad]]);
        }
        break;
        
        case 'truba';
        $evilcoin = $db->query('SELECT evilcoin FROM users WHERE vk_id = ?i', $id)->fetch_assoc()['evilcoin']; // вытягиваем весь баланс
        if($evilcoin < 0.025000) {
            $vk->sendMessage($peer_id,"Труба стоит 0.025000 E Coin ");
        } else {
            $db->query('UPDATE users SET evilcoin = evilcoin - 0.025000 WHERE vk_id = ?i', $id);  
            $db->query('UPDATE users SET coors = coors + 0.000250 WHERE vk_id = ?i', $id);  
            $vk->sendButton($peer_id,"Вы успешно купили Трубу. С вашего баланса снято 0.025000 E Coin",[[$nazad]]);
        }
        break;
        
        case 'press';
        $db->query('UPDATE users SET evilcoin = evilcoin + coors WHERE vk_id = ?i', $id);  
        $coors = $db->query('SELECT coors FROM users WHERE vk_id = ?i', $id)->fetch_assoc()['coors'];
        $vk->sendMessage($peer_id, "+ $coors E Coin");
        break;
        
        case 'evilcoin';
    #    $vk->sendButton($peer_id, "Ошибка 408, возможно данная функция не была включена.
     #   Обратитесь к Администрации.", [[$nazad]]);
        $vk->sendButton($peer_id, "Вы попали в меню Evil Coin", [[$press],[$ins],[$nazad]]);
        break;
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        case 'kazik';
        $vk->sendButton($peer_id, "Вы вошли в казино",[[$igra],[$nazad]]);
        break;
        
        case 'igra';
      
        if ($cmd[1] == 'все' or $cmd[1] == 'всё'){ // Если указано все

            $balance = $db->query('SELECT balance FROM users WHERE vk_id = ?i', $id)->fetch_assoc()['balance']; // вытягиваем весь баланс

            if($balance < 100) {
                $vk->sendMessage($peer_id, 'Для того чтоб зайти в казино нужно больше EFM Coins чем у вас :(');
            } else {
                $result = mt_rand(1, 4); // 1 - проиграл половину, 2 - победа x1.5, 3 - победа x2, 4 - проиграл все
                $win_money = ($result == 1 ? $balance / 2 : ($result == 2 ? $balance * 1.5 : ($result == 3 ? $balance / 2 : 0)));
                $win_nowin = ($result == 1 ? 'проиграли половину' : ($result == 2 ? 'выиграли x1.5' : ($result == 3 ? 'проиграли половину' : 'проиграли все')));
                $vk->sendMessage($peer_id, "Вы $win_nowin, ваш баланс теперь составляет $win_money монет.");
                $db->query('UPDATE users SET balance = ?i WHERE vk_id = ?i', $win_money, $id); // Обновляем данные
            }
        } else {

         $sum = 50;
         $sum = 50;
         $balance = $db->query('SELECT balance FROM users WHERE vk_id = ?i', $id)->fetch_assoc()['balance']; // вытягиваем весь баланс

            if($balance < 100) {
                $vk->sendMessage($peer_id, 'Для того чтоб зайти в казино нужно больше EFM Coins чем у вас :(');
            } else {
            $result = mt_rand(1, 4); // 1 - проиграл половину, 2 - победа x1.5, 3 - победа x2, 4 - проиграл все

            $win_money = ($result == 1 ?  $balance - $sum   : ($result == 2 ? $balance - $sum : ($result == 3 ? $balance + ($sum) : $balance - $sum)));
            $win_nowin = ($result == 1 ? 'проиграли 😶' : ($result == 2 ? 'проиграли 😶' : ($result == 3 ? 'выиграли ' : 'проиграли 😶')));

            $vk->sendMessage($peer_id, "Вы $win_nowin ваш баланс теперь составляет $win_money EFM Coins.");
            $db->query('UPDATE users SET balance =  ?i WHERE vk_id = ?i',  $win_money, $id); // Обновляем данные
            }
        }


    
        break;
        
    case 'nazad';
     $vk->sendButton($peer_id, "Вы вернулись в меню, выбирайте :-)",[[$profile],[$mini, $magaz],[$bonus],[$dop]]);
     break;
     
     case 'prid';
     $vk->sendButton($peer_id, "Введите промокод ", [[$nazad]]);
     break;
     
   case 'magaz';
        $vk->sendButton($peer_id, "Выберите нужный пункт",[[$vivod],[$nazad]]);
        break;
        
    case 'vivod';
        $balance = $db->query('SELECT balance FROM users WHERE vk_id = ?i', $id)->fetch_assoc()['balance']; // вытягиваем весь баланс
if($balance < $minsum) {
            $vk->sendMessage($peer_id, 'Недостаточно средств для вывода.');
 } else {
     $balance = $db->query('SELECT balance FROM users WHERE vk_id = ?i', $id)->fetch_assoc()['balance']; // вытягиваем весь баланс
       $vk->sendButton($peer_id, "Вывод 1000 EFM Coins, перешлите данной сообщение vk.com/90x65x90 в пересланном сообщение добавьте ник и сервер. Ваш идентификационный айди $id");
        $db->query('UPDATE users SET balance =  balance - 1000 WHERE vk_id = ?i', $id); // Обновляем данные
    break;
}
}
