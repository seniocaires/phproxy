<?php 

if (basename(__FILE__) == basename($_SERVER['PHP_SELF']))
{
    exit(0);
}

echo '<?xml version="1.0" encoding="utf-8"?>';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="style.css" title="Default Theme" media="all" />
</head>
<body onload="document.getElementById('address_box').focus()">
<div id="container">
  <h1 id="title"></h1>
<!--
  <ul id="navigation">
    <li><a href="<?php echo $GLOBALS['_script_base'] ?>">URL Form</a></li>
  </ul>
-->
  <?php

switch ($data['category'])
{
    case 'auth':
?>
  <div id="auth"><p>
  <b>Enter your username and password for "<?php echo htmlspecialchars($data['realm']) ?>" on <?php echo $GLOBALS['_url_parts']['host'] ?></b>
  <form method="post" action="">
    <input type="hidden" name="<?php echo $GLOBALS['_config']['basic_auth_var_name'] ?>" value="<?php echo base64_encode($data['realm']) ?>" />
    <label>Username <input type="text" name="username" value="" /></label> <label>Password <input type="password" name="password" value="" /></label> <input type="submit" value="Login" />
  </form></p></div>
<?php
        break;
    case 'error':
        echo '<div id="error"><p>';
        
        switch ($data['group'])
        {
            case 'url':
                echo '<b>URL Error (' . $data['error'] . ')</b>: ';
                switch ($data['type'])
                {
                    case 'internal':
                        $message = 'Falha na conex&atilde;o com o host especificado.'
                                 . 'Poss&iacute;veis problemas s&atilde;o de que o servidor n&atilde;o foi encontrado, a conex&atilde;o expirou, ou a conex&atilde;o foi recusada pelo host.'
                                 . 'Tente conectar novamente e verifique se o endere&ccedil;o est&aacute; correto.';
                        break;
                    case 'external':
                        switch ($data['error'])
                        {
                            case 1:
                                $message = 'A URL que voc&ecirc; est&aacute; tentando acessar est&aacute; na lista negra deste servidor. Selecione outra URL.';
                                break;
                            case 2:
                                $message = 'A URL digitada est&aacute; incorreta. Por favor verifique se voc&ecirc; digitou a URL corretamente.';
                                break;
                        }
                        break;
                }
                break;
            case 'resource':
                echo '<b>Resource Error:</b> ';
                switch ($data['type'])
                {
                    case 'file_size':
                        $message = 'O arquivo voc&ecirc; est&aacute; tentando baixar &eacute; muito grande.<br />'
                                 . 'O tamanho m&aacute;ximo permitido &eacute; de <b>' . number_format($GLOBALS['_config']['max_file_size']/1048576, 2) . ' MB</b><br />'
                                 . 'Tamanho do arquivo solicitado &eacute; de <b>' . number_format($GLOBALS['_content_length']/1048576, 2) . ' MB</b>';
                        break;
                    case 'hotlinking':
                        $message = 'Parece que voc&ecirc; est&aacute; tentando acessar um recurso por esse PRX a partir de um site remoto.<br />'
                                 . 'Por razões de seguran&ccedil;a, por favor, utilize o formul&aacute;rio abaixo para fazer isso.';
                        break;
                }
                break;
        }
        
        echo 'Ocorreu um erro ao tentar navegar atrav&eacute;s do PRX. <br />' . $message . '</p></div>';
        break;
}
?>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <ul id="form">
      <li id="address_bar"><label>URL <input id="address_box" type="text" name="<?php echo $GLOBALS['_config']['url_var_name'] ?>" value="<?php echo isset($GLOBALS['_url']) ? htmlspecialchars($GLOBALS['_url']) : '' ?>" onfocus="this.select()" /></label> <input id="go" type="submit" value="Ir" /> <a href="logout.php">Logout</a></li>
      <?php
      
      foreach ($GLOBALS['_flags'] as $flag_name => $flag_value)
      {
          if (!$GLOBALS['_frozen_flags'][$flag_name])
          {
              echo '<li class="option"><label><input type="checkbox" name="' . $GLOBALS['_config']['flags_var_name'] . '[' . $flag_name . ']"' . ($flag_value ? ' checked="checked"' : '') . ' />' . $GLOBALS['_labels'][$flag_name][1] . '</label></li>' . "\n";
          }
      }
      ?>
    </ul>
  </form>
  Fa&ccedil;a durar. Use com modera&ccedil;&atilde;o e n&atilde;o espalhe.
  <div id="footer"></div>
</div>
</body>
</html>
