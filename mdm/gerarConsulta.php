<?php

	require 'conexao.php';	
	require 'prefixo.php';
	require 'funcoes.php';

	if (isset($_GET["t"])){
		$entidade = $_GET["t"];
	}

	$id 		= $_GET["id"];
	$entidade 	= $_GET["entidade"];
?>
<html>
	<head>
		<title>HTML Code</title>
		<?php include 'head.php' ?>
		<style type="text/css">
			#consulta-gerada{
				border:3px solid #EEE;
				float:left;
				width:100%;
				padding:15px;				
			}
		</style>
	</head>
	<body>
		<?php include 'menu_topo.php'; ?>
		<div class="container-fluid">
			<?php include 'cabecalho.php'; ?>
			<div class="row-fluid">
				<div class="col-md-2">
					<?php include 'menu_consulta.php'; ?>	
				</div>
				<div class="col-md-10">
						<legend>
							HTML Code
						</legend>						
						<fieldset>
							<input type="hidden" id="id" name="id">
							<div class="form-group">
								<button id="gerar" name="gerar" type="button" class="btn btn-primary" style="float:right;margin-bottom:5px;width:10%;">Gerar</button>
								<div id="gravando-pagina"></div>
								<input type="text" id="filename" name="filename" class="form-control" value="<?php echo $linha[0]["nome"]; ?>.html" style="float:right;width:89%;margin-right:1%;"/>
								<input type="hidden" id="filenamejs" name="filenamejs" class="form-control" value="<?php echo $linha[0]["nome"]; ?>.js" />
								<input type="hidden" id="filenamecss" name="filenamecss" value="<?php echo $linha[0]["nome"]; ?>.css" />
								<input type="hidden" id="filenamehtm" name="filenamehtm" value="<?php echo $linha[0]["nome"]; ?>.htm" />
								<div id="consulta-gerada"></div>
							</div>
						</fieldset>						
				</div>
			</div>
		</div>
	</body>
</html>
<script type="text/javascript">
	$("#gerar").click(function(){
		$.ajax({
			url:"../../index.php",
			data:{
				controller:"gerarconsulta",
				id:"<?=$id?>",
				currentproject:"<?=$_SESSION["currentproject"]?>"
			},
			beforeSend:function(){
				$("#consulta-gerada").html('<img src="../tema/padrao/loading2.gif" id="loading" style="float:left;margin-left:48%;" />');
			},
			complete:function(retorno){
				gerarConsulta(retorno.responseText);
			}
		});
		function gerarConsulta(html){
			$.ajax({
				url:"../../index.php",
				type:"POST",
				data:{
					controller:"mdm/componente",
					op:"criarconsulta",
					html:html,
					filename:$("#filename").val(),
					filenamejs:$("#filenamejs").val(),
					filenamecss:$("#filenamecss").val(),
					filenamehtm:$("#filenamehtm").val(),
					entidade:"<?=$entidade?>",
					urlupload:$("#urlupload").val(),
					currentproject:<?=$_SESSION["currentproject"]?>,
					id:<?=$id?>
				},
				complete:function(){
					$("#consulta-gerada").html("Carregou");
				}
			});
		}	
	});
</script>
<?php
	function write($parms,$retorno=false){
		$cur_encoding = mb_detect_encoding($parms);
		if($cur_encoding == "UTF-8" && mb_check_encoding($parms,'UTF-8')){
			if ($retorno) return $parms;
			else echo $parms;
		}elseif($cur_encoding == "ISO 8859-1" && mb_check_encoding($parms,'ISO 8859-1')){
			if ($retorno) return $parms;
			else echo tdc::utf8($parms);
		}else{
			if ($retorno) return $parms;
			else echo utf8_encode($parms);
		}
	}
	
// Fun????o que retorna o texto em formato HTML Especial
function htmlespecialcaracteres_($string,$tipo){
	
	$html = array('??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'			,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??'	,'??'	,'??'		,'??'		,'??'		,'??'		,'??'		,'??'		,'??');
	$char = array('&Aacute;','&aacute;'	,'&Acirc;'	,'&acirc;'	,'&Agrave;'	,'&agrave;'	,'&Aring;'	,'&aring;'	,'&Atilde;'	,'&atilde;'	,'&Auml;'	,'&auml;'	,'&AElig;'	,'&aelig;'	,'&Eacute;'	,'&eacute;'	,'&Ecirc;'	,'&ecirc;'	,'&Egrave;'	,'&egrave;'	,'&Euml;'	,'&euml;'	,'&ETH;'	,'&eth;'	,'&Iacute;'	,'&iacute;'	,'&Icirc;'	,'&icirc;'	,'&Igrave;'	,'&igrave;'	,'&Iuml;'	,'&iuml;'	,'&Oacute;'	,'&oacute;'	,'&Ocirc;'	,'&ocirc;'	,'&Ograve;'		,'&ograve;'	,'&Oslash;'	,'&oslash;'	,'&Otilde;'	,'&otilde;'	,'&Ouml;'	,'&ouml;'	,'&Uacute;'	,'&uacute;'	,'&Ucirc;'	,'&ucirc;'	,'&Ugrave;'	,'&ugrave;'	,'&Uuml;'	,'&uuml;'	,'&Ccedil;'	,'&ccedil;'	,'&Ntilde;'	,'&ntilde;'	,'&reg;','&copy;','&Yacute;','&yacute;'	,'&THORN;'	,'&thorn;'	,'&szlig;'	,'&ordm;'	,'&ordf;');
	
	$string = str_replace($html,$char,$string);
	
	return $string;
}	
?>