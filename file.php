<?php
namespace classes\files;
use classes\pclzip\PclZip;

/**
 *pt
 * Esta classe trata todas as operações sobre ficheiros
 * Ainda faltam resolver e testar v�rios m�todos
 *
 *en
 * This class handles all file operations
 * There are still several methods to solve and test
 * 
 * @author Ant�nio Lira Fernandes
 * @version 2.0
 * @updated 09-Jan-2021 18:10:03
 */

//Métodos:
// LeFicheiro($ficheiro) - lé um ficheiro que é passado pelo caminho. $ficheiro é o nome mais o caminho. Devolve uma string com o conteudo
//                         do ficheiro.
// add_lst($valor) - Adiciona novo ficheiro na lista de ficheiros da classe. $valor é um novo caminho de uma ficheiro
// add_protocolos($valor) - Adiciona novo protocolos na listas de protocolos da classe. $valor é um novo protocolo.
// chgrp($dir,$grupo) - Muda o dono de uma directoria de modo recursivo. $dir é a directoria. $grupo é o grupo em que pretendemos colocar os
//                      ficheiros.
// chown($dir,$dono) - muda o dono de uma directoria de modo recursivo. $dir é a directoria. $dono é o utilizador em que pretendemos colocar os
//                      ficheiros.
// deleteFiles($listaDeFicheiros) - apaga ficheiros de acordo com uma string com o critério. $listaDeFicheiros - é uma string com um 
//                                  criterio que decreve os ficheiros a serem apagados
// dir($dir) - mosta o conteudo de um directório. $dir é o caminho até ao directório que pretendemos obter a sua lista de ficheiros
// eLocal($caminho) - verifica se um caminho corresponde a um ficheiro local que não está associado a nenhum protocolo remoto. $caminho é o
//                    caminho até ao ficheiro.
// existeDir($caminho) - verifica se um caminho corresponde a uma directoria. $caminho é caminho até ao directório que pretendemos obter a 
//                       sua lista de ficheiros
// existeFicheiro($caminho) - verifica se um caminho corresponde a um ficheiro. $caminho é caminho até ao ficheiro. Pode ser absoluto ou 
//                            relativo ao local onde está a ser executado o ficheiro
// getCam() - devolve o caminho + ficheiro que resultaram da ultima operação
// getEst() - devolve o estado do objecto depois de execuado a última operação
// getFic() - devolve o ficheiro usado na última operação
// getFileType($fileName) - Devolve o tipo de ficheiro. $fileName é o caminho e o ficheiro que queremos perceber o tipo
// getLst() - Devolve a lista de ficheiros que resultaram da última operação
// getMsg() - Devolve uma mensagem que resultou da última operação. A mensagem será uma string genérica que depois deve ser traduzida para 
//            uma lingua.
// getNome() - devolve o nome do ficheiro que resulta da operação anterior
// get_lst($i) - devolve o elemento da lista de ficheiros na posição $i
// get_protocolos($i) - devolve o protocolo na posição $i da lista. $i é a posição no array.
// gravaFicheiroTexto($ficheiro,$texto) - guarda um ficheiro que é passado. $ficheiro é o nome mais o caminho para o ficheiro. $texto é o 
//                                        conteudo a ser guardado no ficheiro
// limpaCaca($string) | cleanSpecialCharacters($string) - Limpa os caracteres especiais nos nomes dos ficheiros. $string é o texto em que pretendemos 
//                                                        substituir caracteres acentuados e por as mesmas letras sem acentos, o ç pelo c e os espaços 
//                                                        por _. Devolve uma string "limpa".
// makeDir($caminho) - cria directorios até ficarmos com a estrutura de ficheiros que é passada. Por exemplo se tivermos uma árvore até 
//                     c:\aa\bb e enviarmos um caminho c:\aa\bb\cc\dd será criado o directório cc e o directorio dd. $caminho é o caminho
//                     com a(s) nova(s) pasta(s) a ser(em) criada(s)
// makeDirold($caminho) - DECREPTED
// moveDir($origem, $destino) - Mover uma directoria
// num_lst() - Devolve o número de ficheiros que existe na lista
// num_protocolos() - devolve o número de elementos que existem na lista de protocolos
// pos_lst($valor) - devolve a posicao de um elemento na lista de ficheiros. Se não existir devolve -1. $valor é o ficheiro que queremos 
//                   pesquisar
// pos_protocolos($valor) - devolve a posicao de um elemento na lista de protocolos. Se não existir devolve -1. $valor é o protocolo que 
//                          queremos pesquisar
// putArrayTiposAceites($ArrayTipos) - guardo o tipo de ficheiros que podem ser manipulados. $ArrayTipos é um array de tipos de ficheiros 
//                                     como por exemplo: array("image/gif","image/pjpeg","image/x-png","image/bmp",
//                                     "application/x-zip-compressed","application/octet-stream")
// putCam($valor) - Guarda um caminho. $valor é um novo caminho
// putFic($valor) - Guarda um nome de uma ficheiro. $valor é um novo ficheiro.
// put_lst($valor,$i) - guarda na lista (lst) na posição i o valor. $valor é o novo valor. $i é a posicao na qual pretendemos escrever
// put_protocolos($valor,$i) - guarda um protocolos na posição i. $valor é o novo valor para o protocolo. $i é a posicao na qual 
//                             pretendemos escrever
// removeDir($dir) - apaga um directório que pode conter ficheiros e outros directórios. $dir é o caminho até ao directório que pretendemos 
//                   apagar
// rm($fileglob) - rm() -- Vigorously erase files and directories. Adaptado do script de bishop in http://pt.php.net/function.unlink.
//                 $fileglob mixed If string, must be a file name (foo.txt), glob pattern (*.txt), or directory name. If array, must be an 
//                 array of file names, glob patterns, or directories.
// soDir($fic) - dado um caminho+ficheiro devolve só o caminho. $fic  é o caminho + ficheiro que pretendemos separar.
// temProtocolo($caminho) - verifica se um caminho começa com a indicação de um protocolo. $caminho é o string do caminho que pretendemos
//                          investigar. Devolve true or false
// toString() - descreve o objecto
// unzips($ficheiro, $destino='', $informa=false) - serve para descompactar um ficheiro e devolve uma confirmação se tudo correr bem. Um 
//                                                  erro de algo falhar. Devolve um array com quatro dimensões: ["msg"] - código da 
//                                                  mensagem, ["est"] - estado da operação, ["cam"] - caminho onde foram guardados os 
//                                                  ficheiros, ["lst"] - array com a lista de ficheiros descompactados. $ficheiro é o 
//                                                  caminho + ficheiro que pretendemos descompactar. $destino é o directório destino dos 
//                                                  ficheiros que serão descompactados. Se não for passado nenhum destino o ficheiro será 
//                                                  descompactado para o mesmo local do ficheiro compactado. $informa define se devem ser 
//                                                  devolvidas informações sobre a descompactação. Por defeito não serão devolvidas 
//                                                  nenhumas informações.
// uploadfile($controloOrigem, $destino) - faz o envio de um ficheiro e retorna o resultado que é um array com 3 dimensões: ["msg"] - código
//                                         da mensagem, ["est"] - estado da operação, ["fic"] - caminho + nome do ficheiro do upload. 
//                                         $controloOrigem é o nome do controlo onde é enviado o nome do ficheiro de origem. $destino é o 
//                                         directório onde queremos alojamos o ficheiro como por exemplo: D:\\moodledata\\assessmentpack\\



class File {

    /**
	 * tamanho m�ximo em bytes 2M
	 */
	var $tamanhoMaximo = 2097152;

    /**
	 * tipo de ficheiros aceites
	 */
	var $tiposAceites = array("image/gif","image/pjpeg","image/x-png","image/bmp","application/x-zip-compressed","application/octet-stream");


    /**
     * messagem com o resultado da ultima opera��o
     */
     var $msg;
     
    /**
     * estado da ultima opera��o:
     *      0 - falhou
     *      1 - correu bem
     */
     var $est;

    /**
     * caminho + ficheiro
     */
     var $cam;


    /**
     * lista de ficheiros
     */
     var $lst=[];
	/**
	 * nome do ficheiro
	 */
	var $fic;

    /**
     * Lista de Protocolos registado
     */
    var $protocolos= array('http://','ftp://','gopher://','https://');

  
  // (pt) Devolve o tipo de ficheiro. $fileName é o caminho e o ficheiro que queremos perceber o tipo
  // (en) provides the extension of a file if it is a file or the dir indication for a directory
  
	public function getFileType($fileName) {
    $res=filetype($fileName);
    if ($res!="dir"){
      $parts=explode(".",$fileName);
      if (count($parts)>1){
        //have extension
        $res= $parts[count($parts)-1];
      }  
    }
    return $res;
    
  }

  //###############################################################
  
	// Limpa os caracteres especiais nos nomes dos ficheiros. $string é o texto em que pretendemos substituir caracteres
  //  acentuados e por as mesmas letras sem acentos, o ç pelo c e os espaços por _. Devolve uma string "limpa".
  
  
  function limpaCaca($string) {
    return $this->cleanSpecialCharacters($string); 
  }
  
  // Clears special characters in file names. $string is the text where we want to replace accented characters with the same unaccented letters, the ç with the c and the spaces with _. Returns a "clean" string.
  // Sometimes file names have special characters which then create problems in file systems, especially when using Latin language accent symbols.
	function cleanSpecialCharacters($string) {
    // matriz de entrada
    $what = array( 'ä','ã','à','á','â','ê','ë','è','é','ï','ì','í','ö','õ','ò','ó','ô','ü','ù','ú','û','À','Á','É','Í','Ó','Ú','ñ','Ñ','ç','Ç',' ','-','(',')',',',';',':','|','!','"','#','$','%','&','/','=','?','~','^','>','<','ª','º' );

    // matriz de saída
    $by   = array( 'a','a','a','a','a','e','e','e','e','i','i','i','o','o','o','o','o','u','u','u','u','A','A','E','I','O','U','n','n','c','C','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_' );

    // devolver a string
    return str_replace($what, $by, $string);
}
	
  
   //###############################################################

	/**
	 * muda o dono de uma directoria de modo recursivo
	 * 
	 * @param dir é a directoria.
     * @param $grupo é o grupo em que pretendemos colocar os ficheiros.
     *                            
	 */
  
  function chgrp($dir,$grupo) {

    system("/bin/chgrp -R $grupo $dir");
        
    }
  
  
  
  
  //###############################################################

	/**
	 * muda o dono de uma directoria de modo recursivo
	 * 
	 * @param dir é a directoria. 
     * @param $dono é o utilizador em que pretendemos colocar os ficheiros.
     *                            
	 */
  
  function chown($dir,$dono) {

    system("/bin/chown -R $dono $dir");
        
    }
  
  
 
	
//###############################################################

	/**
	 * apaga ficheiros de acordo com uma string com o critério
	 * 
	 * @param listaDeFicheiros  é uma string com um criterio que decreve os ficheiros a serem apagados
	 */
	function deleteFiles($listaDeFicheiros){

        $this->rm($listaDeFicheiros);
	}

//###############################################################

	/**
	 * mosta o conteudo de um direct�rio
	 * 
	 * @param dir é o caminho até ao directório que pretendemos obter a sua lista de ficheiros
	 */
	function dir($dir, $order=0, $recursive=false){

    if (substr($dir, strlen($dir)-1, 1) != '/')
       $dir .= '/';

    //echo $dir;
    $list=scandir($dir, $order);
    $this->lst["$dir"]=$list;
    if ($recursive==true){
      foreach ($list as $element){
        if ((is_dir($dir ."/". $element) and ($element!=".") and ($element!=".."))){
          $this->dir($dir ."/". $element, $order, $recursive);
        }
      }  
    }
    
    return $this->lst;

	}

//#######################################################################

	/**
	 * verifica se um caminho começa com a indicação de um protocolo. Devolve true or false
	 *
	 * @param caminho  é o string do caminho que pretendemos investigar.
     * 
	 */
	function temProtocolo($caminho){
//        $ok=true;
        $this->msg="naoprotocolo";
        $this->est=0;
        foreach($this->protocolos as $protocolo){
          $pos=strstr($caminho,$protocolo);
          if ($pos==false){
            //$ok=false;
            //$this->msg="existe";
            //$this->est=0;
          }
          else{
            $this->msg="eprotocolo";
            $this->est=1;
            return true;
          }
        }
        return false;
    }

//#######################################################################

	/**
	 * verifica se um caminho corresponde a um ficheiro local que não está associado a nenhum protocolo remoto.
	 *
	 * @param caminho é o caminho até ao ficheiro.
	 */
	function eLocal($caminho){
        if (($this->temProtocolo ($caminho))||($caminho=="")){;
          return false;
        }
        return true;
    }

  
  //#######################################################################

	/**
	 * verifica se um caminho corresponde a uma directoria
	 *
	 * @param caminho verifica se um caminho corresponde a uma directoria. $caminho é caminho até ao directório que pretendemos obter a sua lista de ficheiros
	 */
	function existeDir($caminho){
    //echo "<br><br>Existe $caminho?";
        if (is_dir ($caminho)){
          $this->msg="existe";
          //echo " Existe!";
          $this->est=1;
          return true;
        }
        else{
          $this->msg="naoexiste";
          //echo " Não Existe!";
          $this->est=0;
          return false;
        }
    }

  
  
//#######################################################################

	/**
	 * verifica se um caminho corresponde a um ficheiro
	 *
	 * @param caminho  é caminho até ao ficheiro
	 */
	function existeFicheiro($caminho){
        if (is_file ($caminho)){
          $this->msg="existe";
          $this->est=1;
          return true;
        }
        else{
          $this->msg="naoexiste";
          $this->est=0;
          return false;
        }
    }

//####################################################################
	
    /**
	 * devolve o caminho + ficheiro que resultaram da ultima operação
	 */
	function getCam(){
      return $this->cam;
	}



	/**
	 * devolve o estado do objecto depois de execuado na última operação
	 */
	function getEst(){
      return $this->est;
	}

	/**
	 * devolve o ficheiro usado na última operação
	 */
	function getFic(){
      return $this->fic;
	}

	/**
	 * Devolve a lista de ficheiros que resultaram da última operação
	 */
	function getLst(){
      return $this->lst;
	}

//#####################################################################

    /**
     * Adiciona novo ficheiro na lista de ficheiros da classe.
     *
     * @param valor é um novo caminho de uma ficheiro
     */
    function add_lst($valor){
        //echo "aqui<br>";
        $i=$this->num_lst();
        //echo "I=$i<br>";
        $this->put_lst($valor,$i);
    }

//######################################################################

    /**
     * devolve o elemento da lista de ficheiros na posição $i
     */
    function get_lst($i){
        //print_r($this->lst);
      //echo array_reduce($this->lst);
        return $this->lst[$i];
    }

//######################################################################

    /**
     * devolve a posicao de um elemento na lista de ficheiros. Se não existir devolve -1.
     *
     * @param valor é o ficheiro que queremos pesquisar
     */
    function pos_lst($valor){
        $j=0;
        foreach($this->lst as $ele){
            if ($ele->nome==$valor){
                return $j;
            }
            $j++;
        }
        return -1;
    }

//######################################################################

    /**
     * guarda na lista (lst) na posição i o valor.
     *
     * @param valor é o novo valor
     * @param i é a posicao na qual pretendemos escrever
     */
    function put_lst($valor,$i){
        $this->lst[$i]=$valor;
    }

//######################################################################

	/**
	 * Devolve o número de ficheiros que existe na lista
	 */
	function num_lst(){
      $n=count($this->lst);
      //echo "<br>".$n;
      return $n;
	}

//######################################################################

	/**
	 * Devolve uma mensagem que resultou da última operação. A mensagem será uma string genérica que depois deve ser traduzida para uma lingua.
	 */
	function getMsg(){
      return $this->msg;
	}

	/**
	 * devolve o nome do ficheiro que resulta da operação anterior
	 */
	function getNome(){
      return $this->nome;
	}

//###################################################################

    /**
     * guarda um ficheiro que é passado. $ficheiro é o nome mais o caminho para o ficheiro. $texto é o conteudo a ser guardado no ficheiro
     *
     */
    function gravaFicheiroTexto($ficheiro,$texto){

        $this->putCam($ficheiro);
        if (!($fp = fopen($ficheiro, "wb"))) {
            $this->msg="gravaficerr - $ficheiro";
            $this->est=0;
            return "";
        }
        //$ole="aa";
        
        if(fputs($fp, $texto)=== FALSE){
            $this->msg="gravaficerr";
            $this->est=0;
            return "";
        }
        $this->msg="gravaficOk";
        $this->est=1;

        fclose($fp);
        return "";
    }


//###################################################################

    /**
     * lé um ficheiro que é passado pelo caminho. $ficheiro é o nome mais o caminho
     * Devolve uma string com o conteudo do ficheiro.
     *
     */
    function LeFicheiro($ficheiro){

        $this->putCam($ficheiro);
        if (!($fp = fopen($ficheiro, "r"))) {
            $this->msg="leficerr";
            $this->est=0;
            return "";
        }
        //$ole="aa";
        $data = fread($fp, filesize($ficheiro));
        $this->msg="lefiok";
        $this->est=1;
        return $data;


    }
    


//###################################################################

	/**
	 * cria directorios até ficarmos com a estrutura de ficheiros que é passada. Por exemplo se tivermos uma árvore até 
     * c:\aa\bb e enviarmos um caminho c:\aa\bb\cc\dd será criado o directório cc e o directorio dd. 
	 * 
	 * @param caminho    é o caminho com a(s) nova(s) pasta(s) a ser(em) criada(s)
	 */
	function makeDir($caminho){

				//echo "entrei: $caminho <br>";
		
        $this->est=0;
				$caminho = str_replace("\\", "/", $caminho);
				$paths=explode("/",$caminho);
				//print_r($paths);
		
				$ant="/";
        
				foreach ($paths as $cam){
						if ($ant!="/"){
							$ant=$ant . "/" . $cam;
						}else{
							$ant="/". $cam;
						}
            //echo "será que existe o directorio: $ant <br>";
            if (!$this->existeDir($ant) and ($ant!="")){
              //echo "Tentar criar directorio: $ant <br>";
              //echo "<br><b>Dir: </b>$ant";
						  mkdir($ant,0777);
						  $this->est=1;
            }
						
				}
				if ($this->est=1){
          $this->msg="mkdirok";
          $this->putCam($caminho);
        }
        else {
          $this->msg="erromk";
        }
				
	}

    //DECREPTED
	function makeDirold($caminho){

        $this->est=0;
        do {
            $dir = $caminho;

            while (!@mkdir($dir,0777)) {
                $dir = dirname($dir);
                $this->est=1;
                if ($dir == '/' || is_dir($dir) )
                break;
            }
        } while ($dir != $caminho);
        if ($this->est=1){
          $this->msg="mkdirok";
          $this->putCam($caminho);
        }
        else {
          $this->msg="erromk";
        }
	}

	
	
	/**
	 * guardo o tipo de ficheiros que podem ser manipulados
	 *
	 * @param ArrayTipos    array de tipos de ficheiros como por exemplo:
	 * array("image/gif","image/pjpeg","image/x-png","image/bmp","application/x-zip-compressed","application/octet-stream")
	 */
	function putArrayTiposAceites($ArrayTipos){
        $this->tiposAceites=$ArrayTipos;
	}

//###################################################################

    /**
     * Guarda um caminho.
   	 *
	 * @param valor é um novo caminho
     */
    function putCam($valor){
      //echo "<br>aquj";
      $this->cam=$valor;
    }

//###################################################################

    /**
     * Guarda um nome de uma ficheiro.
   	 *
	 * @param valor é um novo ficheiro.
     */
    function putFic($valor){
      //echo "<br>aquj";
      $this->fic=$valor;
    }

	
	//#######################################################################################################
	
    //Mover uma directoria
    
	function moveDir($origem, $destino){
		try {
			//echo "aqui";
			rename($origem, $destino);
			
		} catch(Exception $e){
			  echo 'Exceção capturada: ',  $e->getMessage(), "\n";
		}
			
		
		
	}
	
	//#######################################################################################################
	
	/**
	 * apaga um directório que pode conter ficheiros e outros directórios.
	 * 
	 * @param dir  é o caminho até ao directório que pretendemos apagar
	 */
	function removeDir($dir){


    if (substr($dir, strlen($dir)-1, 1) != '/')
       $dir .= '/';

    //echo $dir;

    if (is_dir($dir)){
        if ($handle = opendir($dir)){
            while ($obj = readdir($handle)){
                if ($obj != '.' && $obj != '..'){
                    if (is_dir($dir.$obj)){
                        if (!$this->removeDir($dir.$obj)){
                            $this->est=0;
                            $this->msg="rderro1";
                            return false;
                        }
                    }
                    elseif (is_file($dir.$obj)){
                        if (!unlink($dir.$obj)){
                            $this->est=0;
                            $this->msg="rderro1";
                            return false;
                        }
                    }
                }
            }
            closedir($handle);

            if (!@rmdir($dir)){
                $this->est=0;
                $this->msg="rderro1";
                return false;
            }
            $this->est=1;
            $this->msg="rdok";
            return true;
        }
    }
   $this->est=0;
   $this->msg="rderro1";
   return false;
   }

//##################################################################

/**
 * rm() -- Vigorously erase files and directories.
 * adaptado do script de bishop in http://pt.php.net/function.unlink
 *
 * @param   $fileglob mixed If string, must be a file name (foo.txt),
 *          glob pattern (*.txt), or directory name.
 *          If array, must be an array of file names, glob patterns,
 *          or directories.
 */
function rm($fileglob){

    // � um string
   if (is_string($fileglob)) {

       //echo "<br>� string";
       // � um ficheiro
       if (is_file($fileglob)) {
           //echo "<br>� um ficheiro";
           $this->est=unlink($fileglob);
           if ($this->est){
                $this->msg="rmokf";
           }
           else{
                $this->msg="rmerro2";
           }
           return;
       }

       // � um direct�rio
       if (is_dir($fileglob)) {
           //echo "<br>� um direct�rio";
           $ok = $this->rm("$fileglob/*");
           if (! $ok) {
                $this->est=$ok;
                $this->msg="rmerro1";
                return;
           }
           $this->est=rmdir($fileglob);
           if ($this->est){
                $this->msg="rmokd";
           }
           else{
                $this->msg="rmerro3";
           }
           return;
       }

        // conjunto de ficheiros
       $matching = glob($fileglob);
       if ($matching === false) {
            $this->est=0;
            $this->msg="rmerro4";
            return;
       }
       else {
            // decompor array de ficheiros
            if (is_array($matching)){
                $rcs = array_map('$this->rm', $matching);
                if (in_array(false, $rcs)) {
                    $this->est=0;
                    $this->msg="rmerro4";
                    return;
                }
            }

       }



    }


    // � um array de ficheiros
    if (is_array($fileglob)) {
            $rcs = array_map('rm', $fileglob);
            if (in_array(false, $rcs)) {
                $this->est=0;
                $this->msg="rmerro4";
                return;
            }
    }
    else {
        $this->est=0;
        $this->msg="rmerro5";
        return;
    }
    $this->est=1;
    $this->msg="rmokfs";
    return;
}

//##################################################################

    /**
     * dado um caminho+ficheiro devolve só o caminho.
     *
   	 * @param fic   é o caminho + ficheiro que pretendemos separar.
     **/
    function soDir($fic){

        //echo "Fic /: $fic<br>";
        $n=strlen($fic);
        if ($n<1){
            $this->est=0;
            $this->msg="direrro1";
            return;
        }
        $pos1=strrpos($fic,"/");
        $pos2=strrpos($fic,"\\");
        
        //echo "Pos /: $pos1<br>";
        //echo "Pos: \\:$pos2<br>";
        
        if ($pos1 || $pos2){
                //echo "Tenho uma barra pelo menos<br>";
                // tem uma barra
            if (!$pos1 && !$pos2){
                //echo "Tenho duas barras pelo menos<br>";
                // tem uma barra / e uma \ pelo menos
              if ($pos1 > $pos2){
                $pos=$pos1;
              }else {
                $pos=$pos2;
              }
                //tem uma barra / ou uma \ pelo menos
            }else {
                if ($pos1<>false){
                  //echo "Tenho a barra /<br>";
                  $pos=$pos1;
                }else {
                  //echo "Tenho a barra \<br>";
                  $pos=$pos2;
                }
            }
            //echo "Pos: $pos<br>";
            $this->putFic(substr($fic,$pos+1,strlen($fic)));
            $this->putCam(substr($fic,0,$pos));
            $this->est=1;
            $this->msg="lefiok";
            return;
        }else{
                // n�o tem barra
            $this->est=0;
            $this->msg="direrro1";
            return;
        }
        return;
    }

//##################################################################

    /**
	 * serve para descompactar um ficheiro e devolve uma confirmação se tudo correr bem. Um 
     * erro de algo falhar. Devolve um array com quatro dimensões: ["msg"] - código da 
     * mensagem, ["est"] - estado da operação, ["cam"] - caminho onde foram guardados os
     * ficheiros, ["lst"] - array com a lista de ficheiros descompactados. $ficheiro é o
     * caminho + ficheiro que pretendemos descompactar. $destino é o directório destino dos 
//                                                  ficheiros que serão descompactados. Se não for passado nenhum destino o ficheiro será 
//                                                  descompactado para o mesmo local do ficheiro compactado. $informa define se devem ser 
//                                                  devolvidas informações sobre a descompactação. Por defeito não serão devolvidas 
//                                                  nenhumas informações.
	 *
	 * @param ficheiro   é o caminho + ficheiro que pretendemos descompactar.
	 * @param destino    é o directório destino dos ficheiros que serão descompactados. Se não for passado nenhum destino o ficheiro será
     *                   descompactado para o mesmo local do ficheiro compactado.
	 * @param informa    define se devem ser devolvidas informações sobre a descompactação. Por defeito não serão devolvidas
     *                   nenhumas informações.
	 */
    function unzips($ficheiro, $destino='', $informa=false){
        if (!empty($ficheiro)) {

	// n�o sei sobre a fun��o pathinfo
            $path_parts = pathinfo(cleardoubleslashes($ficheiro));
            $zippath = $path_parts["dirname"]; //The path of the zip file
            $zipfilename= $path_parts["basename"];//The name of the zip file
            $extension = $path_parts["extension"];//The extension of the file

            //se o ficheiro n�o tem extens�o
            if (empty($extension)) {
                $this->est=0;
                $this->msg="unzipfileserror2";
                return;
            }

            //n�o foi passado o destino
            if (empty($destino)) {
                $destino = $zippath;
            }

            //limpar o $destino
            $destpath = rtrim(cleardoubleslashes($destino), "/");

            //verifica o destino
            if (!is_dir($destpath)) {
                $this->msg="unzipfileserror3";
                $this->est=0;
                return;
            }

            //Check destination path is writable. TODO!!

            //Everything is ready:
            //    -$zippath is the path where the zip file resides (dir)
            //    -$zipfilename is the name of the zip file (without path)
            //    -$destpath is the destination path where the zip file
            // will uncompressed (dir)

            if (empty($CFG->unzip)) {   // Use built-in php unzip function

                //include_once("$CFG->libdir/pclzip/pclzip.lib.php");
                $archive = new PclZip(cleardoubleslashes("$zippath/$zipfilename"));
                if (!$list = $archive->extract(PCLZIP_OPT_PATH, $destpath,
                                       PCLZIP_CB_PRE_EXTRACT, 'unzip_cleanfilename')) {
                    //notice($archive->errorInfo(true));
                    $this->msg="unzipfileserror4";
                    $this->est=0;
                    return;
                }

                // Use external unzip program
                $separator = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN' ? ' &' : ' ;';
                $redirection = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN' ? '' : ' 2>&1';
                $command = 'cd '.escapeshellarg($zippath).$separator;
                $command .= escapeshellarg($CFG->unzip).' -o ';
                $command .= escapeshellarg(cleardoubleslashes("$zippath/$zipfilename"));
                $command .= ' -d '. escapeshellarg($destpath).$redirection;

				//All converted to backslashes in WIN
                if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
  		            $command = str_replace('/','\\',$command);
  		        }
          		Exec($command,$list);
			}

       		//Display some info about the unzip execution
            if ($informa) {
                $this->lst=$list;
                $this->cam=$destpath;
            }
            $this->est=1;
            $this->msg="unzipok";
            //echo "aqui";
            return;
        }

        $this->msg="unzipfileserror1";
        $this->est=0;

    }

//######################################################################

    /**
	 * faz o envio de um ficheiro e retorna o resultado que � um array
	 * com 3 dimens�es:
     *      ["msg"] - c�digo da mensagem
     *      ["est"] - estado da opera��o
     *      ["fic"] - caminho + nome do ficheiro do upload
	 *
	 * @param controloOrigem    nome do controlo onde � enviado o nome do ficheiro de
	 * origem
	 * @param destino    direct�rio onde queremos alojamos o ficheiro como por exemplo:
	 * D:\\moodledata\\assessmentpack\\
	 */
	function uploadfile($controloOrigem, $destino){


	   $arquivo = $_FILES[$controloOrigem];
	   //echo "<br>nome do controlo: ".$controloOrigem;
	   //echo "<br>nome do ficheiro: ".$arquivo['name'];
	   //echo "<br>Erro do ficheiro: ".$arquivo['error'];
	   //echo "<br>UPLOAD_ERR_INI_SIZEx: ".UPLOAD_ERR_INI_SIZE;
	   if($arquivo['error'] != 0) {
          $this->est=0;
		  switch($arquivo['error']) {
		      case  UPLOAD_ERR_INI_SIZE:      //1
                    $this->msg="erro1";
				    break;
		      case UPLOAD_ERR_FORM_SIZE:      //2
                    $this->msg="erro2";
				    break;
		      case  UPLOAD_ERR_PARTIAL:       //3
				    $this->msg="erro3";
				    break;
		      case UPLOAD_ERR_NO_FILE:        //4
				    $this->msg="erro4";
				    break;
		      case  UPLOAD_ERR_NO_TMP_DIR:    //6
				    $this->msg="erro8";
				    break;
		      case UPLOAD_ERR_CANT_WRITE:     //7
				    $this->msg="erro9";
				    break;
		    }

        //echo $this->msg;
        //echo $this->est;
		  return;
	   }
	   //echo "<br>Tamanho: ".$arquivo['size'];
	   if($arquivo['size']==0 OR $arquivo['tmp_name']==NULL) {
		  $this->msg="erro5";
		  $this->est=0;
		  return;
	 }
  	   //echo "<br>Tamanho: ".$arquivo['size'];
  	   //echo "<br>Tamanho Maximo: ".$this->tamanhoMaximo;
	   if($arquivo['size']>$this->tamanhoMaximo) {
		  $this->msg="erro1";
		  $this->est=0;
		  return;
	   }
       //echo "<br>Tipo: ".$arquivo['type'];
	   if(array_search($arquivo['type'],$this->tiposAceites)===FALSE) {
		  $this->msg="erro6";
		  $this->est=0;
		  return;
	   }
	// Agora podemos copiar o arquivo enviado
	//$destino = 'C:\\Inetpub\\wwwroot\\PHP5\\Capitulo 8\\arquivos_upload\\' . $arquivo['name'];
	   $destino.=$arquivo['name'];
	   if(move_uploaded_file($arquivo['tmp_name'],$destino)) {
          $this->msg="envioOk";
          $this->est=1;
          $this->fic=$destino;
          //echo $this->msg;
		  return;
	   }
	   else {
          $this->msg="erro7";
          $this->est=0;
		  return;
	   }
	}

//####################################################################

	/**
	 * compactar um conjunto de ficheiros num ficheiro zip
	 */
	function zips(){
	}

//#####################################################################

    /**
     * Adiciona novo protocolos na listas de protocolos da classe.
     *
     * @param valor novo valor
     */
    function add_protocolos($valor){
        $i=$this->num_protocolos();
        $this->put_protocolos($valor,$i);
    }

//######################################################################

    /**
     * devolve o protocolo na posição $i da lista. $i é a posição no array.
     */
    function get_protocolos($i){
        return $this->protocolos[$i];
    }

//######################################################################

    /**
     * devolve a posicao de um elemento na lista de protocolos. Se não existir devolve -1.
     *
     * @param valor é o protocolo que queremos pesquisar
     */
    function pos_protocolos($valor){
        $j=0;
        foreach($this->protocolos as $ele){
            if ($ele->nome==$valor){
                return $j;
            }
            $j++;
        }
        return -1;
    }

//######################################################################

    /**
     * guarda um protocolos na posição i.
     *
     * @param valor é o novo valor para o protocolo.
     * @param i é a posicao na qual pretendemos escrever
     */
    function put_protocolos($valor,$i){
        $this->protocolos[$i]=$valor;
    }

//#######################################################################

    /**
     * devolve o número de elementos que existem na lista de protocolos
     */
    function num_protocolos(){
        return count($this->protocolos);
    }


//#######################################################################

	/**
	 * descreve o objecto
	 */
	function toString(){
      $txt="";
      
      $txt.="Caminho: " . $this->getCam() . "<br>";
      $txt.="Ficheiro: " . $this->getFic() . "<br>";
      $txt.="Estado: " . $this->getMsg() . "<br>";
      $txt.="Mensagem: " . $this->getEst() . "<br>";
      
      $n=$this->num_protocolos();
      if ($n>0){
        $txt.="Protocolos<br>";
        for($i=0;$i<$n;$i++){
            $txt.=$this->get_protocolos($i)."<br>";
        }
      }
      $n=$this->num_lst();
      //echo "N: $n<br>";
      if ($n>0){
        $txt.="Lista de Ficheiros<br>";
        foreach($this->lst as $key =>$elementoArray){
            $txt.="<b>" . $key . "</b><br>";
            foreach($elementoArray as $elemento){
              $txt.=$elemento."<br>";
            }
        }
      }
      return $txt;
	}

}

//####################################################################
// exemplos de utiliza��o
//echo "teste";

//$a= new File();
//$a->rm("D:/testeficheiro/bbbbb.txt"); // apagar um ficheiro
//$a->removeDir("D:/testeficheiro/bbbb");  // remover directorio
//$a->makeDir("D:/testephp/bbb/ccc");  // criar directorio
//$a->add_protocolos('\\');
//$a->temProtocolo('\\aaa.asp');
//echo $a->leficheiro("D:/mowes_portable/www/esmusers/classes/files/SinopticoAlunos.csv"); // le um ficheiro
//$a->dir('/var/www/html/galeriaview/2do/fs/');
//$a->soDir('D:/sites\qti/dados.mdb');
//$a->dir($a->getCam());
//$a->gravaFicheiroTexto("D:/testeficheiro/Novo.txt","Hoje est� um belo dia & isto fica na 2� linha");
//a->unzips("D:/testephp/bbb/bbb.zip","D:/testephp/bbb");
//echo "<br>Estado: ".$a->getEst();
//echo "<br>Mensagem: ".$a->getMsg();
//echo "<br>".$a->toString();

?>
