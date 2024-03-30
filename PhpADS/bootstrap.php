<?php

require __DIR__."/vendor/autoload.php";

$metodo = $_SERVER['REQUEST_METHOD'];
$caminho = $_SERVER['PATH_INFO'] ?? '/';

#use Php\Primeiroprojeto\Router
$r = new Php\Primeiroprojeto\Router($metodo, $caminho);

#ROTAS

$r->get('/olamundo', function (){
    return "Olá mundo!";
} );

$r->get('/olapessoa/{nome}', function($params){ 
    return 'Olá'.$params[1]; 
} );

$r->get('/home', function(){
    include("home.html");
});

$r->get('/exer1/formulario', function(){
    include("exer1.html");
});

$r->get('/exer2/formulario', function(){
    include("exer2.html");
});

$r->get('/exer3/formulario', function(){
    include("exer3.html");
});

$r->get('/exer4/formulario', function(){
    include("exer4.html");
});

$r->get('/exer5/formulario', function(){
    include("exer5.html");
});

$r->get('/exer6/formulario', function(){
    include("exer6.html");
});

$r->get('/exer7/formulario', function(){
    include("exer7.html");
});

$r->get('/exer8/formulario', function(){
    include("exer8.html");
});

$r->get('/exer9/formulario', function(){
    include("exer9.html");
});

$r->get('/exer10/formulario', function(){
    include("exer10.html");
});

$r->post('/exer1/resposta', function(){
    $valor = $_POST['valor'];
    if($valor > 0) {
        echo 'Valor positivo';
    } elseif ($valor == 0) {
        echo 'Igual a zero';
    } else {
        echo 'Valor negativo';
    }
});

$r->post('/exer2/resposta', function(){
    $valor1 = $_POST['valor1'];
    $valor2 = $_POST['valor2'];
    $valor3 = $_POST['valor3'];
    $valor4 = $_POST['valor4'];
    $valor5 = $_POST['valor5'];
    $valor6 = $_POST['valor6'];
    $valor7 = $_POST['valor7'];
    $array = array($valor1,$valor2,$valor3,$valor4,$valor5,$valor6,$valor7);
    $minimo = min($array);
    $indice = array_search($minimo,$array) + 1;
    echo 'O menor número é: ' . $minimo . ' que foi o ' . $indice . 'º número inserido';
    
});

$r->post('/exer3/resposta', function(){
    $valor1 = $_POST['valor1'];
    $valor2 = $_POST['valor2'];
    if($valor1 == $valor2) {
        $resultado = $valor1 + $valor2;
        $resultadoTriplo = $resultado * 3;
        echo $resultadoTriplo;
    }else {
        $resultado = $valor1 + $valor2;
        echo $resultado;
    }
    
});

$r->post('/exer4/resposta', function(){
    $valor = $_POST['valor'];
    for ($i = 0; $i <= 10; $i++) {
        $resultado = $valor * $i;
        echo "$valor X $i = $resultado <br>";
    }
});

$r->post('/exer5/resposta', function(){
    $valor = $_POST['valor'];
    $fatorial = 1;
    for ($i = 1; $i <= $valor; $i++) {
        $fatorial *= $i;
        return $fatorial;
    }
    echo $fatorial;
});

$r->post('/exer6/resposta', function(){
    $valor1 = $_POST['valor1'];
    $valor2 = $_POST['valor2'];
    if ($valor1 < $valor2) {
        echo "$valor1 $valor2";
    } elseif ($valor1 > $valor2) {
        echo "$valor2 $valor1";
    } else {
        echo "Números iguais: $valor1";
    }
    
});

$r->post('/exer7/resposta', function(){
    $metros = $_POST["valor"];
    $centimetros = $metros * 100;
    echo $centimetros;
    
});

$r->post('/exer8/resposta', function(){
    $area = $_POST['valor'];
    $litros = $area / 3;
    $quantidade_latas = ceil($litros / 18);
    $preco = $quantidade_latas * 80;
    echo 'Preço: ' . $preco . " para " . $quantidade_latas . " latas.";
});

$r->post('/exer9/resposta', function(){
    $nascimento = $_POST['valor'];
    $idade = 2024 - $nascimento;
    echo 'Você tem ' . $idade . " anos.<br>";
    $dias = $idade * 365;
    echo 'Você viveu ' . $dias . " dias.<br>";
    $futuro = 2025 - $nascimento;
    echo 'Em 2025 você terá ' . $futuro . ' anos.';
});

$r->post('/exer10/resposta', function(){
    $peso = $_POST['valorPeso'];
    $altura = $_POST['valorAltura'];
    $imc = $peso / ($altura * $altura);
    if ($imc < 18.5) {
        $condicao = "abaixo do peso";
    } elseif ($imc >= 18.5 && $imc < 24.9) {
        $condicao = "com peso normal";
    } elseif ($imc >= 25 && $imc < 29.9) {
        $condicao = "com sobrepeso";
    } else {
        $condicao = "obeso";
    }
    echo "Seu IMC é: " . number_format($imc, 1) . '<br>';
    echo "Você está ". $condicao;
});
#ROTAS

$resultado = $r->handler();

if(!$resultado){
    http_response_code(404);
    echo "Página não encontrada!";
    die();
}

echo $resultado($r->getParams());