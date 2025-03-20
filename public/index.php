<?php 

// *** DEBUG
// echo "Upload max file size: " . ini_get('upload_max_filesize') . '<br>';
// echo "Post max size: " . ini_get('post_max_size') . '<br>';
// echo "Mem Limit: " . ini_get('memory_limit') . '<br>';

// ini_set('post_max_size', '1024M');
// ini_set('upload_max_filesize', '512M');

session_start();

$baseDir = dirname(__DIR__, 1) . '/';

require $baseDir . 'vendor/autoload.php';

use Oestrangeiro\Transfer\Transfer;

$t = new Transfer();

// PRG (post-redirect-get)
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	$t->setFiles();
	$filesUploadedMsg = $t->save();
	$_SESSION['filesUploadedMsg'] =$filesUploadedMsg;
	
	if(!empty($filesUploadedMsg)){
		header('Location: ' . $_SERVER['PHP_SELF']);
		exit;
	}

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Transfer</title>
	<meta charset="utf-8">
	<meta lang="pt-br">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<!-- Bootstrap 5 CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="container-fluid">
	<!-- Bootstrap 5 JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

	<div class="col">
		<h2 class="bg-success float-left text-white p-1 md-4">Transfer</h2>
	</div>

	<div class="row">
		<div class="col">
			<form class="form" action="<?php echo basename(__FILE__) ?>" method="POST" enctype="multipart/form-data">
				<h4 class="form pb-2">Insira seus arquivos:</h4>
					<div class="row">
						<div class="col-4">
							<input class="form-control col-4 pb-2" type="file" multiple="multiple" name="files[]">	
						</div>
						<div class="col pb-2">
							<button class="btn btn-success pb-2" type="submit" >Upload</button>	
						</div>	
					</div>
				</div>
			</form>		
		</div>
	</div>
<!-- Se houver a mensagem na sessão, imprimo -->
<?php if(isset($_SESSION['filesUploadedMsg'])): ?>
<div class="alert alert-success">
	<?= $_SESSION['filesUploadedMsg'] ?>
</div>
<!-- Apago a mensagem da sessão -->
<?php endif; unset($_SESSION['filesUploadedMsg']) ?>
</body>
</html>




