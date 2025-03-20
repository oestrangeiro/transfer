<?php
namespace Oestrangeiro\Transfer;

/*
	Classe que facilita a transferência de arquivos
	entre meu computador e meu celular.

	@author: Mateus 'oestrangeiro' Almeida
*/

class Transfer{

	protected $baseDir = '';
	// Nome da pasta aonde serão salvos os arquivos, modifique se desejar
	protected $folderNameToSaveFiles = 'uploaded_files/';
	// Nome da pasta aonde será salvo informações de logs
	protected $folderNameToSaveLogs = 'logs/';
	// Array com os arquivos que vêm do cliente
	protected $arrayFiles = array();

	public function __construct(){

		// Setando o caminho base
		$this->baseDir = dirname(__DIR__, 3) . '/';
		// Cria, se não existe, a pasta de uploads
		$this->makeDirIfNotExists($this->folderNameToSaveFiles);
		// Cria, se não existe, a pasta de logs
		$this->makeDirIfNotExists($this->folderNameToSaveLogs);
	}

	// Coloca as informações dos arquivos no atributo da classe
	public function setFiles(){
		$this->arrayFiles = $_FILES['files'];
	}

	// Apenas debug
	public function debugShowFiles(){
		echo "<pre>";
		print_r($this->arrayFiles);
		echo "</pre>";
	}

	// Salva os arquivos no servidor
	public function save(){

		$absoluteDirPath = $this->baseDir . $this->folderNameToSaveFiles;
		$successMsg = "";
		$errorMsg = "";

		// $this->debugShowFiles();
		foreach ($this->arrayFiles['name'] as $idx => $value) {
			$tmpName = $this->arrayFiles['tmp_name'][$idx];
			$nameFile = $this->arrayFiles['name'][$idx];
			
			// Tento mover o arquivo para a pasta 'uploaded_files'
			$mvFileStatus = move_uploaded_file($tmpName, $absoluteDirPath . $nameFile);
			if($mvFileStatus){
				$successMsg .= "Arquivo '{$nameFile}' foi salvo com sucesso!<br>";
				$this->saveLogs($nameFile);
			}else{
				$errorMsg .= "Erro ao salvar arquivo '{$nameFile}'!<br>'";	
			}

		}

		if(!empty($errorMsg)){
			return $errorMsg;
		}
		if(!empty($successMsg)){
			return $successMsg;
		}
	}

	// Bem, não vou duvidar da sua capacidade cognitiva
	public function makeDirIfNotExists(string $dirName){

		$dir = $dirName;

		$absoluteDirPath = $this->baseDir . $dir;

		$dirExists = is_dir($absoluteDirPath);
		$mkDirStatus = false;

		if(!$dirExists){
			$mkDirStatus = mkdir($absoluteDirPath);
			if(!$mkDirStatus){
				echo "ERRO FATAL: Não foi possível criar a pasta!<br>";
			}
		}

	}

	// Apenas debug também
	public function debugGetDirPath(){
		return $this->baseDir . $this->folderNameToSaveFiles;
	}

	/*
		Método que registra os logs com:
		IP do cliente,
		Nome do arquivo,
		Data e hora de envio
	*/
	public function saveLogs($nameFile){

		date_default_timezone_set('America/Fortaleza');

		$logName = date('d-m-Y') . '.log';
		$pathToLogs = $this->baseDir . $this->folderNameToSaveLogs;
		$ip = $_SERVER['REMOTE_ADDR'];
		
		$dateAndTime = date('d-m-Y H:i:s');
		
		$content = "{$ip} uploaded '{$nameFile}' at $dateAndTime\n";

		$saveLogStatus = file_put_contents($pathToLogs . $logName, $content, FILE_APPEND);
		if (!$saveLogStatus) {
			echo "ERRO AO SALVAR LOGS!<br>";
		}
	}
}