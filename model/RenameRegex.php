<?php

class RenameRegex{
	private $path;
	private $directory;
	private $pattern;
	private $replacement;
	private $error;

	public function __construct($path, $pattern, $replacement)
	{
		$this->path 		= $path; 
		$this->pattern 		= $pattern;
		$this->replacement 	= $replacement;

		$this->directory = dir($this->path);
		$this->erro = "";
	}
	/**
	*	This method are create for get all Archive in directory
	*	@return array
	*/
	public function getArchives() 
	{
		return $this->directory->read();
	}
	/**
	*	This Method rename all files in directory
	*/
	public function renameAllFiles()
	{
		while( $archive = $this->directory->read() )
		{
			if( is_file( $this->path.$archive ) )
			{
				try{

					$newName = preg_replace( $this->pattern, $this->replacement, $archive);
					if($archive != "." && $archive != ".."  && rename($this->path.$archive, $this->path.$newName) )
						return true;
					else
						throw new Exception(	"Aconteceu um erro ao renomear o arquivo: ". $archive .
												" verifique o pattern: ". $this->pattern .
												" e o replacement: ". $this->replacement
											);
				} catch (Exception $e){
					self::setErro($e->getMessage());
					return false;
				}
			}
		}
	} 

	/**
	*	Rename a archive by name from archive
	*	@param string $name
	*	@return boolean
	*/
	public function renameFileByName( $name) 
	{	try {
			if( is_file( $this->path.$name ) )
			{	
				try{

					$newName = preg_replace( $this->pattern, $this->replacement, $name);
					if( !rename($this->path.$name, $this->path.$newName) ){	
						throw new Exception(	"Aconteceu um erro ao renomear o arquivo: ". $name .
												" verifique o pattern: ". $this->pattern .
												" e o replacement: ". $this->replacement
											);
					}
				} catch (Exception $e){
					self::setErro($e->getMessage());
					return false;
				}
			}else{
				throw new Exception("O nome: ". $name ." não é um arquivo do diretorio: ". $this->path);
			}
		} catch (Exception $e) {
			self::setErro($e->getMessage());
			return false;
		}
	}

	/**
	*	This Method rename all directory 
	*/
	public function renameAllDir()
	{
		while( $archive = $this->directory->read() )
		{
			if( is_dir( $this->path.$archive ) )
			{
				try{

					$newName = preg_replace( $this->pattern, $this->replacement, $archive);
					if( !rename($this->path.$archive, $this->path.$newName) )
					{	
						throw new Exception(	"Aconteceu um erro ao renomear o diretorio: ". $archive .
												" verifique o pattern: ". $this->pattern .
												" e o replacement: ". $this->replacement
											);
					}
				} catch (Exception $e){
					self::setErro($e->getMessage());
				}
			}
		}
	} 

	/**
	*	Rename a directory by name from directory
	*	@param string $name
	*	@return boolean
	*/
	public function renameDirByName( $name) 
	{	try {
			if( is_dir( $this->path.$name ) )
			{	
				try{

					$newName = preg_replace( $this->pattern, $this->replacement, $name);
					if( !rename($this->path.$name, $this->path.$newName) )
					{
						throw new Exception(	"Aconteceu um erro ao renomear a pasta: ". $name .
												" verifique o pattern: ". $this->pattern .
												" e o replacement: ". $this->replacement
											);
					}

				} catch (Exception $e){
					self::setErro($e->getMessage());
					return false;
				}
			}else{
				throw new Exception("O nome: ". $name ." não é uma pasta do diretorio: ". $this->path);
			}
		} catch (Exception $e) {
			self::setErro($e->getMessage());
			return false;
		}
	}






	/**
	*	Setting the erro for variable erro
	*	@param string erro
	*/
	private function setErro($erro){
		$this->erro = $erro;
	}

	/**
	*	Get the erro in application
	*	@return string erro
	*/
	public function getErro()
	{
		return $this->erro;
	} 

	/**
	*	this method return the status on closed DIR
	*	@return boolean	
	*/
	public function close()
	{
		return $directory->close();
	}
}


?>