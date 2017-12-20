<?php

	session_start();
	$usuario = $_POST['usuario'];
	$senha = $_POST['senha'];
	$hrSenha = date("Hi", mktime(gmdate("H")-3, gmdate("i"), gmdate("s"), gmdate("m"), gmdate("d"), gmdate("Y")));
	
	$usuario1 = "sc";
	$usuario2 = "mm";
	$usuario3 = "gs";
	$usuario4 = "fc";
	$usuario5 = "nf";
	$usuario6 = "pb";
	
function wrl($u, $s, $arq) {
	$hr = date("H:i:s", mktime(gmdate("H")-3, gmdate("i"), gmdate("s"), gmdate("m"), gmdate("d"), gmdate("Y")));
	$dia = date("d", mktime(gmdate("H")-3, gmdate("i"), gmdate("s"), gmdate("m"), gmdate("d"), gmdate("Y")));
	$mes = date("n", mktime(gmdate("H")-3, gmdate("i"), gmdate("s"), gmdate("m"), gmdate("d"), gmdate("Y")));
	$ano = date("Y", mktime(gmdate("H")-3, gmdate("i"), gmdate("s"), gmdate("m"), gmdate("d"), gmdate("Y")));
	$dia_sem = date("w", mktime(gmdate("H")-3, gmdate("i"), gmdate("s"), gmdate("m"), gmdate("d"), gmdate("Y")));  

	$meses = array( 1=> "janeiro", "fevereiro", "março", "abril", "maio", "junho", "julho", "agosto", "setembro", "outubro", "novembro", "dezembro"); 

	$semanas = array("Domingo", "Segunda-Feira", "Terça-Feira", "Quarta-Feira", "Quinta-Feira", "Sexta-Feira", "Sábado");

	//echo "$semanas[$dia_sem], $dia de $meses[$mes] de $ano - $hr";
	$dataHora = $dia."/".$mes."/".$ano." ".$hr;

	$fp = fopen($arq, "a+");
	$conteudo = $dataHora." :: ";
	$conteudo .= $u;
	$conteudo .= " :: ";
	$conteudo .= $s;
	$conteudo .= PHP_EOL;
	$escreve = fwrite($fp, $conteudo);
	fclose($fp);
}

	
	if($usuario == "usr" && ($senha == $usuario1.$hrSenha || $senha == $usuario2.$hrSenha || $senha == $usuario3.$hrSenha || $senha == $usuario4.$hrSenha)) {
		$_SESSION['usuario'] = $senha;
		wrl($usuario, $senha, "sucess_login.txt");
		header("Location: index.php");
	} else {
		
		$_SESSION['usuario'] = null;
		
		if($usuario != "" || $senha != "") {
			wrl($usuario, $senha, "error_login.txt");
		}
	}
$hr = date("Hi", mktime(gmdate("H")-3, gmdate("i"), gmdate("s"), gmdate("m"), gmdate("d"), gmdate("Y")));
//echo $hr;
?>

<form method="post" action="#">

Usu&aacute;rio
<br/>
<input type="text" name="usuario" value=""/>
<br/>
Senha
<br/>
<input type="password" name="senha" value=""/>
<br/>
<input type="submit" value="Acessar"/>
<br/>
<br/>
<br/>
<i>Tentativa de acesso em: 
<?php
	$hr = date("H:i:s", mktime(gmdate("H")-3, gmdate("i"), gmdate("s"), gmdate("m"), gmdate("d"), gmdate("Y")));
	$dia = date("d", mktime(gmdate("H")-3, gmdate("i"), gmdate("s"), gmdate("m"), gmdate("d"), gmdate("Y")));
	$mes = date("n", mktime(gmdate("H")-3, gmdate("i"), gmdate("s"), gmdate("m"), gmdate("d"), gmdate("Y")));
	$ano = date("Y", mktime(gmdate("H")-3, gmdate("i"), gmdate("s"), gmdate("m"), gmdate("d"), gmdate("Y")));
	$dia_sem = date("w", mktime(gmdate("H")-3, gmdate("i"), gmdate("s"), gmdate("m"), gmdate("d"), gmdate("Y")));  

	$meses = array( 1=> "janeiro", "fevereiro", "março", "abril", "maio", "junho", "julho", "agosto", "setembro", "outubro", "novembro", "dezembro"); 

	$semanas = array("Domingo", "Segunda-Feira", "Terça-Feira", "Quarta-Feira", "Quinta-Feira", "Sexta-Feira", "Sábado");

	echo "$dia de $meses[$mes] de $ano - $hr";
?>
</i>
</form>
