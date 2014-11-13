<?php
/*
 * 1.MEJORADA FUNCION CONEXION
2.MEJORADA FUNCION QuerySQL (FIXED: muestra si hay error en la consulta MySQL)
3.AÑADIDA FUNCION WHERE Y LIKE CON EXPRESIONES REGULARES
4.PENDIENTE::::::IMPLEMENTAR SINGLETON. y CREAR FUNCIONES PARA SESIONES PROPIAS DE LA CLASE 
	PARA QUE PERSISTA LA CONEXION Y LA VIDA UTIL DE LA CLASE! (En Otro Archivo)
5. FIXED Añadido soporte UTF8 para impresión o muesttra de datos
6. FIXED Añadido Colectores de datos (Probados y funcionando :))
7. FIXED Añadido Importacion de datos a MySQL mediante archivos CSV de excel
8. FIXED Añadido Exportacion de BD MySQL Actual y una que sea especificada por el programador o usuario
9. Añadidas funciones de Fechas y conversion de fechas a Integer
 * 10. Añadida funcion de ExportCSV para exportar archivos a CSV
 * 11. Añadida funcion para ver el numero de campos de una tabla
 * 12. 
*/
class op_mysql{
	protected $limitesql;
	protected $wheresql1;
	protected $relasql;
	protected $wheresql2;
	protected $tabla;
	protected $campodata;
	protected $tablareport;
	protected $resultsql;
	protected $tipotab;
	protected $pedido;
	protected $resp;
	protected $condicional;
	protected $conexion;
	protected $bd;
	protected $puerto;
	protected $servidor;
	protected $usrbd;
	protected $contbd;
	protected $lastped;
	protected $lastcons;
	protected $lastfilas;
	protected $lastablemk;
	protected $idinsert;
	protected $nomlogin;
	protected $clavelogin;
	protected $nivellogin;
	protected $mdclavlogin;
	protected $tablaulogin;
	protected $niveladmin;
	protected $nivelusuario;
	protected $collationbd;
	protected $charsetbd;
	protected $lastpedos;
	protected $idconsnxpvv;
	protected $idaux;
	protected $numvalins;
	protected $numcamins;
	protected $nderror;
	protected $errormsj;
	protected $numcampos;
	//////////////////////////// EMAIL MESSAGES ////////////////////7
	protected $emailerror;
	protected $nemailerror;
	protected $nemailmessage;
	protected $emailmessage;
	protected $numarchivosmail;
	protected $anioString;
	protected $mesString;
	protected $diaString;
	protected $dateString;
	protected $archivosmail=array();
	protected $archivosmail_t=array();
	protected $archivosmail_s=array();
	protected $archivosmail_tf=array();
	//////////////////////////////////////////////////////////////////////
	protected $charcampos=array();
	protected $campos=array();
	protected $valores=array();
	protected $valupda=array();
	protected $camupda=array();
	protected $links=array();
	protected $consults=array();
	protected $codifica;
	//colector de arrays de datos llamados por getAllData()
	protected $nomecolector=array();
	protected $numcolectors=0;
	protected $datanumcolector=array();
	////////////////////////////////////////////////////////
	//conectar a BD CON CLAVE
	function ConectarBD($usuario,$clave,$server,$bd){
		if($usuario!='' && $clave!='' && $server!='' && $bd!=''){
			if($this->conexion!=''){
				$conex_tmp=$this->conexion;
				mysql_close($conex_tmp);
			}
			else{
				if($this->puerto==''){
					$this->puerto='3306';
				}
				
				$lcon=mysql_connect($server,$usuario,$clave);
				if($lcon){
					$bdsel=mysql_select_db($bd);
					if($bdsel){
						$this->conexion=$lcon;
						$this->usrbd=$usuario;
						$this->contbd=$clave;
						$this->servidor=$server;
						$this->bd=$bd;
						$this->puerto='3306';
						return 0;
					}
					else{
						return -3;
					}
				}
				else{
					return -2;
				}	
			}
		}
		else{
			if($this->usrbd!=''){
				$usuario=$this->usrbd;
			}
			else{
				return -3;
			}
			
			if($this->contbd!=''){
				$clave=$this->contbd;
			}
			else{
				return -3;
			}
					
			if($this->servidor!=''){
				$server=$this->servidor;
			}
			else{
				return -3;
			}
			
			if($this->bd!=''){
				$bd=$this->bd;
			}
			else{
				return -3;
			}
			
			if($this->conexion!=''){
				$conex_tmp=$this->conexion;
				mysql_close($conex_tmp);
			}
			else{
				$this->puerto='3306';
				$lcon=mysql_connect($server,$usuario,$clave);
				if($lcon){
					$bdsel=mysql_select_db($bd);
					if($bdsel){
						$this->conexion=$lcon;
						return 0;
					}
					else{
						return -1;
					}
				}
				else{
					return -2;
				}
			}
		}
	}
	//conectar a la BD SIN CLAVE
	function ConectarBD_SC($usuario,$clave,$server,$bd){
		if($usuario!='' && $server!='' && $bd!=''){
			if($this->conexion!=''){
				$conex_tmp=$this->conexion;
				mysql_close($conex_tmp);
			}
			else{
				if($this->puerto==''){
					$this->puerto='3306';
				}
				
				$lcon=mysql_connect($server,$usuario,$clave);
				if($lcon){
					$bdsel=mysql_select_db($bd);
					if($bdsel){
						$this->conexion=$lcon;
						$this->usrbd=$usuario;
						$this->contbd=$clave;
						$this->servidor=$server;
						$this->bd=$bd;
						$this->puerto='3306';
						return 0;
					}
					else{
						return -3;
					}
				}
				else{
					return -2;
				}	
			}
		}
		else{
			if($this->usrbd!=''){
				$usuario=$this->usrbd;
			}
			else{
				return -3;
			}
			
			if($this->contbd!=''){
				$clave=$this->contbd;
			}
			else{
				return -3;
			}
					
			if($this->servidor!=''){
				$server=$this->servidor;
			}
			else{
				return -3;
			}
			
			if($this->bd!=''){
				$bd=$this->bd;
			}
			else{
				return -3;
			}
			
			if($this->conexion!=''){
				$conex_tmp=$this->conexion;
				mysql_close($conex_tmp);
			}
			else{
				$this->puerto='3306';
				$lcon=mysql_connect($server,$usuario,$clave);
				if($lcon){
					$bdsel=mysql_select_db($bd);
					if($bdsel){
						$this->conexion=$lcon;
						return 0;
					}
					else{
						return -1;
					}
				}
				else{
					return -2;
				}
			}
		}
	}
	
	function setConexif($idconex){
		$this->conexion=$idconex;
		return 0; 
	}
	
	function getConexif(){
		return $this->conexion;
	}
	
	function showConexif(){
		if($this->conexion!=''){
			$this->printCad($this->conexion);
		}
		else{
			return -1;
		}
	}
	
	public function setCodif($codificacion){
		$codificacion=strtolower($codificacion);

		if($codificacion=='utf8'){
			$this->codifica=$codificacion;		
		}
		else{
			$this->printCad(utf8_decode("Codificación no soportada"));
		}
	}
	
	public function getCodif(){
		if($this->codifica!=''){
			return $this->codifica;		
		}
		else{
			return -1;
		}
	}	
	
	/****************************************************************************************************
	 * 																									*
	 * 																									*
	 * 											START DATA COLECTOR										*
	 * 																									*
	 * 																									*
	 * **************************************************************************************************/	
	public function seekDataColector($nombre){
		if($nombre!=''){
			$encontrado=-2;
			for($i=0;$i<=($this->numcolectors-1);$i++){
				if($this->nomecolector[$i]==$nombre){
					$encontrado=0;
					return $encontrado;
				}
			}
			
			if($encontrado==-2){
				return $encontrado;
			}
		}
		else{
			return -1;
		}
	}

	//set Working Colector
	public function setWColector($nombre){
		if($nombre!=''){
			if($this->seekDataColector($nombre)==0){
				$this->nombrewcol=$nombre;
				return 0;
			}
			else{
				return -2;
			}
		}
		else{
			return -1;
		}
	}
	
	//get Working Colector
	public function getWColector(){
		if($this->nombrewcol!=''){
			return $this->nombrewcol;
		}
		else{
			return -1;
		}		
	}
	
	//INTERNO de la funcion (no para el desarrollador)
	public function seekIDColector($nombre){
		$encontrado=-2;
		for($i=0;$i<=($this->numcolectors-1);$i++){
			if($this->nomecolector[$i]==$nombre){
				$encontrado=$i;
				return $encontrado;
			}
		}
		
		if($encontrado==-2){
			return $encontrado;
		}
	}
	//////////////////////////////////

	public function setDataColector($nombre){
		$arrayDatos=array();
		/* setDataColector busca la ultima sentencia SQL la ejecuta 
		 * y almacena los datos pertinentes en un Array,
		 * luego los almacena en el colector de datos para su posterior operación*/
		if($this->seekDataColector($nombre)!=0){
			//utilizando sin argumentos la funcion QuerySQL obtiene la ultima consulta MySQL Hecha
			if($this->QuerySQL()==0){
				if($this->getFilas()>0){
					while($data=$this->getData()){
						$arrayDatos[]=$data;			
					}
					// y vacia los datos pertinentes en el ArrayDatos
					$this->nomecolector[$this->numcolectors]=$nombre;
					$this->datanumcolector[$this->numcolectors]=$arrayDatos;
					$this->numcolectors++;
					return 0;
				}
				else{
					return -2;
				}
			}
			else{
				return -3;
			}
		}
		else{
			return -1;
		}
	}
	
	public function setDataColector_dif($nombre,$arrayDatos){
		if($this->seekDataColector($nombre)!=0){
			$this->nomecolector[$this->numcolectors]=$nombre;
			$this->datanumcolector[$this->numcolectors]=$arrayDatos;
			$this->numcolectors++;
			return 0;
		}
		else{
			return -1;
		}
	}

	public function setVariable($nombre,$arrayDatos){
		if($this->seekDataColector($nombre)!=0){
			$this->nomecolector[$this->numcolectors]=$nombre;
			$this->datanumcolector[$this->numcolectors]=$arrayDatos;
			$this->numcolectors++;
			return 0;
		}
		else{
			$id=$this->seekIDColector($nombreColector);
			if($id!=''){
				$this->datanumcolector[$id]=$arrayDatos;
			}
			return 1;
		}
	}
	
	//devuelve un array si existe el colector
	public function getDataColector($nombre){
		if($this->seekDataColector($nombre)==0){
			$id=$this->seekIDColector($nombre);
			return $this->datanumcolector[$id];
		}
		else{
			return -1;
		}
	}
	//mostrar informacion precisa alamacenada en los colectores
	public function showDataInColector($nombreColector,$campo,$campomos,$valorStr){
		if($this->seekDataColector($nombreColector)==0){
			$id=$this->seekIDColector($nombreColector);
			if($valorStr!=''){
				//mostrar informacion precisa alamacenada en los colectores
				//listado
				$this->printCad("<table border='1'>");
					$this->printCad("<thead>");
						$this->printCad("<th>".$campomos."</th>");
					$this->printCad("</thead>");
					
					$this->printCad("<tbody>");
						//trabaja con Arrays Tridimensionales
						foreach($this->datanumcolector[$id] as $llave => $valor){
							if($valorStr==$this->datanumcolector[$id][$llave][$campo]){
								$this->printCad("<tr>");
									$this->printCad("<td>".$this->datanumcolector[$id][$llave][$campomos]."</td>");
								$this->printCad("</tr>");
							}
						}
					$this->printCad("</tbody>");
				$this->printCad("</table>");			
			}
			else{
				//mostrar informacion precisa alamacenada en los colectores
				//listado
				$this->printCad("<table border='1'>");
					$this->printCad("<thead>");
						$this->printCad("<th>".$campo."</th>");
					$this->printCad("</thead>");
					
					$this->printCad("<tbody>");
						foreach($this->datanumcolector[$id] as $llave => $valor){
							$this->printCad("<tr>");
								$this->printCad("<td>".$this->datanumcolector[$id][$llave][$campo]."</td>");
							$this->printCad("</tr>");
						}
					$this->printCad("</tbody>");
				$this->printCad("</table>");
				
			}
		}
		else{
			return -1;
		}	
	}
	
	public function getDataInColector($nombreColector,$campo,$valorStr){
		//obtiene alguna informacion y la devuelve en forma de Array, no la imprime
		if($this->seekDataColector($nombreColector)==0){
			$id=$this->seekIDColector($nombreColector);
			$datos=array();
			if($valorStr!=''){
				foreach($this->datanumcolector[$id] as $llave => $valor){
					if($valorStr==$this->datanumcolector[$id][$llave][$campo]){
						$datos[]=$this->datanumcolector[$id][$llave][$campo];
					}
				}
			}
			else{
				foreach($this->datanumcolector[$id] as $llave => $valor){
					$datos[]=$this->datanumcolector[$id][$llave][$campo];
				}
			}
			return $datos;
		}
		else{
			return -1;
		}	
	}
	
	public function eraseDataColector($nombre){
		//elimina el colector y su informacion de el
		if($this->seekDataColector($nombre)==0){
			$id=$this->seekIDColector($nombre);
			$this->nomecolector[$id]=0;
			$this->datanumcolector[$id]=0;
			$this->datanumcolector=$this->orderVector($this->datanumcolector);
			$this->nomecolector=$this->orderVector($this->nomecolector);
			$this->numcolectors--;		
		}
	}
	//ordena un vector con el metodo shell
	public function orderVector($vector){
		//funcion ShellSort en PHP
		
		$i=0;
		$j=0;
		$incrmnt=0;
		$temp=0;
		$size=count($vector);
		
  		$incrmnt = $size/2;
		while ($incrmnt>0){
			for ($i=$incrmnt;$i<$size;$i++){
				$j = $i;
				$temp=$vector[$i];
				while (($j>=$incrmnt) && ($vector[$j-$incrmnt]>$temp)){
					$vector[$j]=$vector[$j-$incrmnt];
					$j=$j-$incrmnt;
				}
				$vector[$j]=$temp;
    		}
    		$incrmnt/=2;
		}
		return $vector;
	}
	/****************************************************************************************************
	 * 																									*
	 * 																									*
	 * 											END DATA COLECTOR										*
	 * 																									*
	 * 																									*
	 * **************************************************************************************************/	
	//funciones tipo slideshow
	public function setNextId(){
		$this->idaux++; 
		return $this->idaux; 
	}

	public function setPrevId(){
		$this->idaux--;
		return $this->idaux;
	}
	
	public function getNextId(){
		return $this->idaux; 
	}

	public function getPrevId(){
		return $this->idaux;
	}
	//////////////////////////	
	function setLimitSQL($limitest){
		$this->limitesql=$limitest;
	}
	
	public function getLimitSQL(){
		return $this->limitesql;
	}
	
	public function setWhereSQL($wherest1,$relwhere,$wherest2){
		//patron /^([A-Z][a-z][0-9])*<|>|=!|<=|>=([A-Z][a-z][0-9])*$*/
		$this->wheresql1=$wherest1;
		$this->relasql=$relwhere;
		$this->wheresql2=$wherest2;
	}

	public function setWhereSQL_regexp($wherestring){
		//patron /^[A-Za-z0-9_]*(<|>|=!|<=|>=)[A-Za-z0-9_]*$/
		$patron="/^([A-Za-z0-9_ ]*)(>|<|>=|<=|!=|==|=|LIKE|NOT|EQUAL|<>)\'([A-Za-z0-9_ ]*)\'/";
		preg_match($patron,$wherestring,$conic);
		if(preg_match($patron,$wherestring,$conic)){
			$this->wheresql1=$conic[1];
			$this->relasql=$conic[2];
			$this->wheresql2=$conic[3];
			return 0;
		}
		else{
			return -1;
		}
	}
	
	public function getWhereSQL_arr(){
		$relarr=array();
		$s1=$this->wheresql1;
		$r1=$this->relasql;
		$s2=$this->wheresql2;
		
		if($s1!='' && $r1!='' && $s2!=''){
			$this->relarr[]=array(
				'Campo 1'=>$s1,
				'Relacion'=>$r1,
				'Campo2'=>$s2);
		}
		return $this->wheresql;
	}

	public function getWhereSQL_str(){
		$s1=$this->wheresql1;
		$r1=$this->relasql;
		$s2=$this->wheresql2;
		
		if($s1!='' && $r1!='' && $s2!=''){
			$strwhere=$s1.$r1.$s2;	
		}
		return $strwhere;
	}
	
	public function setField($campo){
		$this->campodata=$campo;
	}
	
	public function getField(){
		return $this->campodata;		
	}
	
	public function getIDConn(){
		return $this->conexion;
	}
	
	public function getIDInsert(){
		if($this->idinsert!=''){
			$idins=$this->idinsert;
			return $idins;
		}
		else{
			return -1;
		}
	}
	
	public function getLastPedido(){
		//obtiene el ultimo Query para trabajar con este
		return $this->lastped;
	}
	
	public function showContarRegistros($tabla){
		if($this->QuerySQL("SELECT COUNT(*) FROM ".$tabla)==0){
			$this->printCad($this->getSQLResult());
		}
	}

	public function getContarRegistros($tabla){
		if($this->QuerySQL("SELECT COUNT(*) FROM ".$tabla)==0){
			return $this->getSQLResult();
		}
	}
	
	public function showContarRegistrosCondicional($tabla,$condicion){
		if($this->QuerySQL("SELECT COUNT(*) FROM ".$tabla." WHERE ".$condicion)==0){
			$this->printCad($this->getSQLResult());
		}
	}

	public function getContarRegistrosCondicional($tabla,$condicion){
		if($this->QuerySQL("SELECT COUNT(*) FROM ".$tabla." WHERE ".$condicion)==0){
			return $this->getSQLResult();
		}
	}
			
	public function getSQLResult(){
		//para cuando hay un resultado unico
		$this->resultsql=mysql_result($this->lastped,0);
		return $this->resultsql;
	}	

	public function getSQLResultN($fila){
		//Para cuando se quiere un resultado de la fila N
		$this->resultsql=mysql_result($this->lastped,$fila);
		return $this->resultsql;
	}
	
	public function QuerySQL($query){
		//ejecuta la sentencia SQL
		$conn=$this->conexion;
		if($conn){
			$this->lastped='';
			$this->idinsert='';
			$this->lastfilas='';
			
			if($query!=''){
				$this->lastped=mysql_query($query,$conn);
			}
			else{
				$this->lastped=mysql_query($this->lastcons,$conn);
			}
			
			if($this->lastped){
				if($query!=''){
					$this->lastcons=$query;
					$consarr2=explode(' ',$query);
					if($consarr2[0]=='SELECT'){
						$this->lastfilas=mysql_num_rows($this->lastped);
					}
					$consarr=explode(' ',$query);
					$this->idinsert=mysql_insert_id();
					$this->nderror=mysql_error();
					if($this->nderror!=''){
						$this->printCad($this->nderror);
						return -1;
					}
					else{
						return 0;
					}
				}
				else{
					$query=$this->lastcons;
					$consarr2=explode(' ',$query);
					if($consarr2[0]=='SELECT'){
						$this->lastfilas=mysql_num_rows($this->lastped);
					}						
					$consarr=explode(' ',$query);
					if($consarr[0]=='INSERT'){
						$this->printCad($consarr[0]);
						$idins=mysql_insert_id();
						$this->idinsert=$idins;
					}
					$error=mysql_error();
					if($error!=''){
						$this->nderror=mysql_error();
						$this->printCad($this->nderror);
						return -1;
					}
					else{
						return 0;
					}
				}
				$this->nderror=mysql_error();
				if($this->nderror!=''){
					$this->nderror=mysql_error();
					$this->printCad($this->nderror);
					return -1;
				}
				else{
					return 0;
				}				
			}
			else{
				$error=mysql_error();
				if($error!=''){
					$this->nderror=mysql_error();
					$this->printCad(mysql_error());
					return -1;
				}
				else{
					return 0;
				}
			}
			if($error!=''){
				$this->nderror=mysql_error();
				$this->printCad(mysql_error());
				return -1;
			}
			else{
				return 0;
			}
		}
		else{
			if($error!=''){
				$this->nderror=mysql_error();
				$this->printCad($this->nderror);
				return -1;
			}
			else{
				return 0;
			}
		}
		
		if($error!=''){
			$this->nderror=mysql_error();
			$this->printCad($this->nderror);
			return -1;
		}
		else{
			return 0;
		}
	}
	
	public function getError(){
		if($this->lastcons!=''){
			$error="<h3>".$this->nderror."</h3>";
		}
		else{
			$error="<h3>".$this->nderror."</h3>";
		}
		
		return $this->nderror;
	}
	
	public function showError(){
		if($this->lastcons!=''){
			$error="<h3>".$this->nderror."</h3>";
			$this->printCad($error);
		}
		else{
			$error="<h3>".$this->nderror."</h3>";
			$this->printCad($error);
		}
		return 0;
	}	
	
	public function de_utf8($mensaje){
		if($this->codifica!=''){
			if($this->codifica=='utf8'){
				$msjcod=utf8_decode($mensaje);
			}
		}
		else{
			$msjcod=$mensaje;
		}
		return $msjcod;
	}
	
	public function en_utf8($mensaje){
		if($this->codifica!=''){
			if($this->codifica=='utf8'){
				$msjcod=utf8_encode($mensaje);
			}
		}
		else{
			$msjcod=$mensaje;
		}
		
		return $msjcod;
	}
	
	/******************************************************************************
	 * 
	 *                                   ENVIO DE EMAILS
	 * 
	 * 
	 * ***************************************************************************/
	 //Envia email normalito
	public function SendEmail($sender,$subject,$message,$destino){
		//dirección del remitente
		$headers .= "From: ".$sender."\r\n";
		//dirección de respuesta, si queremos que sea distinta que la del remitente
		$headers .= "Reply-To: ".$sender."\r\n";
		$message=$this->de_utf8($message);
		
		if(mail($destino,$subject,$message,$headers)){
			$error="";
			$this->setEmailErrorZero();
			return 0;
		} 
		else{
			$error="No envio el email";
			$this->setEmailError($error);
			return -1;
		}
	}
	//Establece el mensaje del email
	public function setEmailMessage($message){
		$this->emailmessage=$message;
		return 0;
	}
	//Obtiene el mensaje del email
	public function getEmailMessage(){
		if($this->emailmessage!=''){
			return $this->emailmessage; 
		}
		else{
			return -1;
		}
	}
	//Muestra mensaje de mail
	public function showEmailMessage(){
		if($this->emailmessage!=''){
			$this->printCad(($this->emailmessage)); 
			return 0;
		}
		else{
			return -1;
		}
	}
	//agrega archivos al array de archivos para el email con adjuntos
	public function AddFilesToMail($file){
		$this->archivosmail[$this->numarchivosmail]=$_FILES[$file]['name'];
		$this->archivosmail_t[$this->numarchivosmail]=$_FILES[$file]['type'];
		$this->archivosmail_s[$this->numarchivosmail]=$_FILES[$file]['size'];
		$this->archivosmail_tf[$this->numarchivosmail]=$_FILES[$file]['tmp_file'];
		$this->numarchivosmail++;
	}
	
	//ENVIA EMAIL CON CODIFICACION HTML ISO
	public function Send_HTML_Email($sender,$subject,$message,$destino){
		//Con codificacion UTF8
		//dirección del remitente
		//para el envío en formato HTML
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
		$headers .= "From: ".$sender."\r\n";
		//dirección de respuesta, si queremos que sea distinta que la del remitente
		$headers .= "Reply-To: ".$sender."\r\n";
		$headers .= 'X-Mailer: PHP/' . phpversion();
		$message=$this->de_utf8($message);
		
		if(mail($destino,$subject,$message,$headers)){
			$this->setEmailErrorZero();
			return 0;
		} 
		else{
			$error="No envio el email";
			$this->setEmailError($error);
			$this->showEmailError($error);
			return -1;
		}
	}
	
	public function setEmailError($error){
		$this->emailerror=$error;
		return 0;
	}

	public function setEmailErrorZero(){
		$this->emailerror="";
		return 0;
	}
				
	public function getEmailError(){
		if($this->emailerror!=''){
			return $this->emailerror; 
		}
		else{
			return -1;
		}
	}
	
	public function showEmailError(){
		$error=$this->getEmailError();
		if($error!=''){
			$this->printCad($this->emailerror);
			return 0; 
		}
		else{
			return -1;
		}		
	}	
	
	/******************************************************************************
	 * 
	 *                                   END ENVIO DE EMAILS
	 * 
	 * 
	 * ***************************************************************************/
	 
	 	
	public function printCad($mensaje){
		echo($mensaje);
	}

	public function de_printo($mensaje){
		if($this->codifica!=''){
			if($this->codifica=='utf8'){
				$msjcod=$this->de_utf8($mensaje);
				$this->printCad($msjcod);
				return 0;
			}
		}
		else{
			return -1;
		}
	}

	public function en_printo($mensaje){
		if($this->codifica!=''){
			if($this->codifica=='utf8'){
				$msjcod=$this->en_utf8($mensaje);
				$this->printCad($msjcod);
				return 0;
			}
		}
		else{
			return -1;
		}
	}
	
	public function codecho($option,$string){
		if($option=='decode'){
			$this->printCad($this->de_utf8($string));
		}
		elseif($option=='encode'){
			$this->printCad($this->en_utf8($string));
		}
	}
	
	//OBTENCION DE DATOS
	public function getOnlyFilas($query){
		$conn=$this->conexion;
		if($conn){
			if($query!=''){
				$this->lastped=mysql_query($query,$conn);
			}
			else{
				$this->lastped=mysql_query($this->lastcons,$conn);
			}
			
			if($this->lastped){
				if($query!=''){
					$this->lastcons=$query;
					$this->lastfilas=mysql_num_rows($this->lastped);
					$consarr=explode(' ',$query);
					if($consarr[0]=='INSERT'){
						$this->idinsert=mysql_insert_id();
					}
					return $this->lastfilas;
				}
				else{
					$query=$this->lastcons;
					$this->lastfilas=mysql_num_rows($this->lastped);						
					$consarr=explode(' ',$query);
					
					if($consarr[0]=='INSERT'){
						$idins=mysql_insert_id();
						$this->idinsert=$idins;
					}
					return $this->lastfilas;
				}
			}
			else{
				$error=$this->de_utf8("ERROR -1 No se ejecutó el pedido");
				$this->nderror=$error;
				return $error;
			}
		}
		else{
			$error="ERROR -2 no hay conexion";
			$this->nderror=$error;
			return $error;
		}	
	}
	
	public function getData(){
		$pedido=$this->lastped;
		$data=mysql_fetch_array($pedido);
		return $data;
	}
	
	public function getData_ante(){
		return $this->getData_dif($this->lastped);
	}
	
	public function getAllData(){
		$arrayresult=array();
		
		$pedido=$this->lastped;
		if($pedido){
			while($datasd=mysql_fetch_array($pedido)){
				$arrayresult[]=$datasd;
			}
			return $arrayresult;		
		}
		else{
			return -1;
		}
	}
	
	public function getData_dif($pedido){
		$datares=array();
		$conn=$this->conexion;
		if($conn){
			$consulta=$this->lastcons;
			$pedido=mysql_query($consulta,$conn);
			if($pedido){
				$this->lastped=$pedido;
				$filas=mysql_num_rows($pedido);
				if($filas>0){
					$datares[]=mysql_fetch_array($pedido);
					return $datares;
				}
			}
			else{
				return -1;
			}
		}
		else{
			return -1;
		}
	}
	
	public function getAllData_dif($pedido){
		$datares=array();
		
		$conn=$this->conexion;
		if($conn){
			$consulta=$this->lastcons;
			$pedido=mysql_query($consulta,$conn);
			if($pedido){
				$this->lastped=$pedido;
				$filas=mysql_num_rows($pedido);
				if($filas>0){
					while($datanop=mysql_fetch_array($pedido)){
						$datares[]=$datanop;
					}
					return $datares;
				}
			}
			else{
				return -1;
			}
		}
		else{
			return -1;
		}
	}
	
	public function getDataNumFields(){
		$pedido=$this->lastped;
		$data=mysql_num_fields($pedido);
		return $data;
	}
	
	function printArray($var){
		print_r($var);
		return 0;
	}
	
	//DEVUELVE UN ARRAY CON LOS DATOS SOLICITADOS
	public function getDataFields(){
		$conn=$this->conexion;
		$limite=$this->limitesql;
		if($conn){
			$tablai=$this->tabla;
			$numargs = func_num_args();
		    $argulist = func_get_args();
		    $query="SELECT ";
		    
		    if($argulist[0]!='*'){
			    for($i=0;$i<$numargs;$i++){
			    	if($i!=($numargs-1)){
			    		$query.=$argulist[$i].", ";
			    	}
			    	else{
			    		$query.=$argulist[$i];
			    	}
			    }
		    }
		    else{
		    	$query.='* ';
		    }
	    	
	    	if($limite!=''){
	    		$query.=" FROM ".$tablai." LIMIT ".$limite;	
	    	}
	    	else{
	    		$query.=" FROM ".$tablai;    	
	    	}
	    	
			if($query!=''){
				$this->lastped=mysql_query($query,$conn);
			}
			else{
				$this->lastped=mysql_query($this->lastcons,$conn);
			}
			
			if($this->lastped){
				if($query!=''){
					$this->lastcons=$query;
					$this->lastfilas=mysql_num_rows($this->lastped);
						
					$consarr=explode(' ',$query);
					
					if($consarr[0]=='INSERT'){
						$idins=mysql_insert_id();
						$this->idinsert=$idins;
					}
					
					$data=mysql_fetch_array($this->lastped);
					return $data;	
				}
				else{
					$query=$this->lastcons;
					$this->lastfilas=mysql_num_rows($this->lastped);
					
					$consarr=explode(' ',$query);
					
					if($consarr[0]=='INSERT'){
						$idins=mysql_insert_id();
						$this->idinsert=$idins;
					}
					$data=mysql_fetch_array($this->lastped);
					return $data;				
				}
			}
			else{
				$error="<h3>".mysql_error()."</h3>";
				return $error;
			}
		}
	}
	
	public function getStringToInt($date){
		$dato=intval($date);
		return $dato; 
	}	

	public function showStringToInt($date){
		$result=$this->getStringToInt($date);
		$this->printCad($result);
		return 0;
	}	
	
	public function getSeparar($cad,$separador){
		$data=explode($separador,$cad);
		return $data; 
	}

	public function showSeparar($cad,$separador){
		$data=explode($separador,$cad);
		return $data; 
	}
		
	public function getAnio($date){
		$data=$this->getSeparar($date, "-");
		$anio=$data[0];
		return $anio; 	
	}

	public function getMes($date){
		$data=$this->getSeparar($date, "-");
		$mes=$data[1];
		return $mes; 		
	}

	public function getDia($date){
		$data=$this->getSeparar($date, "-");
		$dia=$data[2];
		return $dia;		
	}

	public function getIntAnio($date){
		$data=$this->getAnio($date);
		$data=intval($data);
		return $data; 	
	}

	public function getIntMes($date){
		$data=$this->getMes($date);
		$data=intval($data);
		return $data; 		
	}

	public function getIntDia($date){
		$data=$this->getDia($date);
		$data=intval($data);
		return $data;
	}
	
	public function showAnio($date){
		$data=$this->getAnio($date);
		$this->printCad($data);
		return 0;
	}

	public function showMes($date){
		$data=$this->getMes($date);
		$this->printCad($data);
		return 0; 		
	}

	public function showDia($date){
		$data=$this->getDia($date);
		$this->printCad($data);
		return 0;		
	}

	public function getAllDataFields(){
		$datos=array();
		$limite=$this->limitesql;
		$conn=$this->conexion;
		if($conn){
			$tablai=$this->tabla;
			$numargs = func_num_args();
		    $argulist = func_get_args();
		    $query="SELECT ";
		    
		    if($argulist[0]!='*'){
			    for($i=0;$i<$numargs;$i++){
			    	if($i!=($numargs-1)){
			    		$query.=$argulist[$i].", ";
			    	}
			    	else{
			    		$query.=$argulist[$i];
			    	}
			    }
		    }
		    else{
		    	$query.="* ";
		    }
		    
		    if($this->wheresql1!='' && $this->relasql!='' && $this->wheresql2!=''){
		    	$query.=" FROM ".$tablai." WHERE ".$this->wheresql1.$this->relasql.$this->wheresql2;
		    }
		    else{
		    	$query.=" FROM ".$tablai;
		    }
	    
			if($limite!=''){
		    	$query.=" LIMIT ".$limite;
		    }
	    	
			if($this->QuerySQL($query)){
				return 0;
			}
			else{
				reuturn -1;
			}
		}
	}
	/****************************************************************************************************
	 * 																									*
	 * 																									*
	 * 											IMPORTACION/EXPORTACION DE DATOS						*
	 * 																									*
	 * 																									*
	 * **************************************************************************************************/
	
	public function ImportSQL($usuario, $passwd, $DB){
		$executa="/wamp/mysql/bin/mysqldump -u$usuario -p$passwd $DB";  
		system($executa, $resultado);  
		if($resultado){
			echo("<H1>Error ejecutando comando: $executa</H1>\n");  
		} 
	}
	
	public function ImportCSV($archivo,$BD,$tabla){
		$conn=$this->conexion;
		if($conn){
			if(mysql_query("LOAD DATA INFILE '".$archivo."' INTO TABLE ".$tabla." FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n'",$conn)){
				return 0;
			}
		}
	}
	
	public function ExportCSV($archivo,$sql){
		$conn=$this->conexion;
		if($conn){
			if($this->QuerySQL($sql)==0){
				$campos=$this->getDataNumFields();
				$csv_terminated = "\n";
				    $csv_separator = ";";
				    $csv_enclosed = '"';
				    $csv_escaped = "\\";
				    $sql_query = $sql;
				 
				    // Gets the data from the database
				    $fields_cnt = $this->getDataNumFields();
				    $schema_insert = '';
				 
				    for ($i = 0; $i < $fields_cnt; $i++){
				        $l = $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed,
				            stripslashes(mysql_field_name($this->lastped, $i))) . $csv_enclosed;
				        $schema_insert .= $l;
				        $schema_insert .= $csv_separator;
				    } // end for
				 
				    $out = trim(substr($schema_insert, 0, -1));
				    $out .= $csv_terminated;
				 
				    // Format the data
				    while ($row = $this->getData()){
				        $schema_insert = '';
				        for ($j = 0; $j < $fields_cnt; $j++){
				            if ($row[$j] == '0' || $row[$j] != ''){
				 
				                if ($csv_enclosed == ''){
				                    $schema_insert .= $row[$j];
				                } 
				                else{
				                    $schema_insert .= $csv_enclosed .
				                    str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $row[$j]) . $csv_enclosed;
				                }
				            } 
				            else{
				                $schema_insert .= '';
				            }
				 
				            if ($j < $fields_cnt - 1){
				                $schema_insert .= $csv_separator;
				            }
				        } // end for
				 
				        $out .= $schema_insert;
				        $out .= $csv_terminated;
				    } // end while
			}
		}
		header("Pragma: no-cache");
		header("Expires: 0");
		header("Content-Transfer-Encoding: binary");
		header("Content-type: application/force-download");
		header("Content-Disposition: attachment; filename=$filename");
		// Change the folder you want this uploaded to
	    $folder = date("j_M_Y_G_i_s");
	    $back_up_filename = $folder . '_REPORTE.csv';
	    
	    if(!file_exists($folder))
	    {
	        mkdir($folder);
	    }
	    file_put_contents($back_up_filename, $out);
	}	
	
	public function ExportSQL(){
		//fijo el date de hoy
		$date_month = date('m');
		$date_year = date('Y');
		$date_day = date('d');
		$Date = "$date_year-$date_month-$date_day";
		//Archivo
		$filename = "mydb_respaldo_".$Date.".sql";
		//Datos BD
		$usuario=$this->getUsuario();  // Usuario de la base de datos, un ejemplo podria ser 'root'
		$passwd=$this->getClaveUsuario();  // Contraseña asignada al usuario
		$bd=$this->getBD();  // Nombre de la Base de Datos a exportar
		header("Pragma: no-cache");
		header("Expires: 0");
		header("Content-Transfer-Encoding: binary");
		header("Content-type: application/force-download");
		header("Content-Disposition: attachment; filename=$filename");
		//para Unix
		$executa = "mysqldump -u $usuario --password=$passwd --opt $bd";
		system($executa,$resultado);
		
		if($resultado){
			$this->printCad("<H1>Error ejecutando comando: $executa</H1>\n");
		}
	}
	
	public function ExportarSQL_dif($bd,$filename){
		if($bd!=''){
			//fijo el date de hoy
			$date_month = date('m');
			$date_year = date('Y');
			$date_day = date('d');
			$Date = "$date_year-$date_month-$date_day";
			if($filename==''){
				//Archivo
				$filename = "mydb_respaldo_".$Date.".sql";
			}
			else{
				//Datos BD
				$usuario=$this->getUsuario();  // Usuario de la base de datos, un ejemplo podria ser 'root'
				$passwd=$this->getClaveUsuario();  // Contraseña asignada al usuario
				header("Pragma: no-cache");
				header("Expires: 0");
				header("Content-Transfer-Encoding: binary");
				header("Content-type: application/force-download");
				header("Content-Disposition: attachment; filename=$filename");
				//para Unix
				$executa = "mysqldump -u $usuario --password=$passwd --opt $bd";
				system($executa,$resultado);
				
				if($resultado){
					//si el procedimiento ha fallado
					$this->printCad("<H1>Error ejecutando comando: $executa</H1>\n");
					return -1;
				}
				//si el procedimiento ha sido exitoso
				return 0;
			}
		}
		else{
			//si el procedimiento ha sido fallido
			return -1;
		}
	}
	/****************************************************************************************************
	 * 																									*
	 * 																									*
	 * 											END IMPORTACION DE DATOS								*
	 * 																									*
	 * 																									*
	 * **************************************************************************************************/	
	public function showDataTableReport(){
		$datares=array();
		$argulist=array();
		$subtits=array();
		$numsubtit=0;
		$numargu=0;
		$camposnt=array();
		$retfunc;
		
		$conn=$this->getIDConn();
		if($conn){
			$consulta=$this->lastcons;		
			$pedido=mysql_query($consulta,$conn);
			if($pedido!=''){
			//obtener numero de argumentos
			    $numargs = func_num_args();
			    $argulist = func_get_args();
			    $this->printCad("<table border='1'>");
			    $this->printCad("<thead>");
			    for($i=0;$i<$numargs;$i++){
			    	$argu=$argulist[$i];
			    	
			    	//validar si el campo existe
			    	$tabla=$this->tablareport;
			    	if($tabla==''){
			    		return -2;
			    	}
			    	else{
				    	if($this->isCampo($tabla,$argulist[$i])!=0){
				    		$this->printCad("<th>".strtoupper(utf8_decode($argu))."</th>");
				    		$subtits[]=$argu;
							$this->numsubtit++;
				    	}
				    	else{
				    		$camposnt[]=$argu;
				    		$this->numargu++;
				    	}
			    	}
			    }

			    $this->printCad("</thead>");
			    if($this->numsubtit!=$this->numargu){
			    	return -3;
			    }

				$this->lastped=$pedido;
				$filas=mysql_num_rows($pedido);
				if($filas>0){
					$this->printCad("<tbody>");
					while($datanop=mysql_fetch_array($pedido)){
						$this->datares[]=$datanop;
					}
					
					for($i=0;$i<=$filas;$i++){
						$this->printCad("<tr>");
						$numcol=$this->numsubtit;
						for($u=0;$u<$numcol;$u++){
							$this->printCad("<td>");
							$thcamp=$camposnt[$u];
							$this->printCad(utf8_decode($this->datares[$i][$thcamp]));
							$this->printCad("</td>");
						}
						$this->printCad("<tr>");
					}			
					$this->printCad("<tr>");
					$this->printCad("<td>");
					$this->printCad("N. Registros: ".$filas);
					$this->printCad("</td>");
					$this->printCad("<tr>");
					$this->printCad("</tbody>");
					$this->printCad("</table>");
					return 0;
				}
			}
			else{
				$this->printCad(mysql_error());
			}
		}
		else{
			return -1;
		}		
	}
	
	//Ejecuta dos sentencias SQL para seleccion e insercion de datos con validacion de filas
	public function InsComplex($q1,$q2,$filasi,$mensaje){
		//ejecutar dos sentencias: una de seleccion y otra de insert o delete o update u otra select;
		//0:FILAS==0
		//1:FILAS>0
		$conn=$this->conexion;
		if($conn!=''){
			if($q1!='' && $q2!='' && $filasi!='' && $mensaje!=''){
				$this->lastped=mysql_query($q1,$conn);
				$pedido=$this->lastped;
				if($pedido){
					$this->lastfilas=mysql_num_rows($pedido);
					$this->lastcons=$q1;
					
					if($filasi=='0'){
						if($this->lastfilas==0){
							$pedinsert=mysql_query($q2,$conn);
							if($pedinsert){
								$mensajemsj=uft8_decode($mensaje);
								$this->printCad($mensajemsj);
							}
						}
						else{
							$this->nderror="Item ya existente en la BD";
							$this->printCad("Item ya existente en la BD");
						}
					}
					elseif($filasi=='1'){
						if($this->lastfilas>0){
							$pedinsert=mysql_query($q2,$conn);
							if($pedinsert){
								$mensajemsj=uft8_decode($mensaje);
								$this->printCad($mensajemsj);
							}						
						}
						else{
							$this->nderror="Item no existente en la BD";
							$this->printCad("Item no existente en la BD");
						}				
					}
					elseif($filasi=='2'){
						if($this->lastfilas>0 && $this->lastfilas<2){
							$pedinsert=mysql_query($q2,$conn);
							if($pedinsert){
								$mensajemsj=uft8_decode($mensaje);
								$this->printCad($mensajemsj);
							}
						}	
						else{
							$this->nderror="N. de item fuera de rango.";
							$this->printCad("N. de item fuera de rango.");
						}				
					}
					
				}
				else{
					$error=mysql_error();
					return $error;
				}
			}
			else{
				return -1;
			}
		}
		else{
			return -1;
		}
	}
	
	public function getNumCampos(){
		return $this->numcampos;
	}

	public function getCharCampos(){
		return $this->charcampos;
	}
	
	public function Consecutive(){
		$conn=$this->conexion;
		if($conn){
			//hacer script para sentencias consecutivas
			$numargs = func_num_args();
		    $argulist = func_get_args();
			$consultas=array();

			for($i=0;$i<$numargs;$i++){
				$consultas[$i]=$argulist[$i];
			}
			
			for($i=0;$i<$numargs;$i++){
				$query=$consultas[$i];
				$this->lastped=mysql_query($query,$conn);
				$this->numcampos=mysql_num_fields($this->lastped);
				$consarr=explode(' ',$query);
				
				for($u;$u<$this->numcampos;$u++){
					$this->charcampos[$u]=mysql_field_name($this->lastped,$u);
				}
				
				if($consarr[0]=='INSERT'){
					if($this->lastped){
						$idins=mysql_insert_id();
						$this->idinsert=$idins;
						return 0; 
					}
					else{
						return -1;
					}
				}
				elseif($consarr[0]=='SELECT'){
					if($this->lastped){
						$this->lastfilas=mysql_num_rows($this->lastped);
						$this->idinsert=$idins;
						return 0; 
					}
					else{
						return -1;
					}					
				}
				
				return $this->charcampos;
			}
		}
	}
	
	public function getFilas(){
		$conn=$this->conexion;
		if($conn){
			$pedidoe=$this->lastped;
			if($pedidoe){
				$filas=mysql_num_rows($pedidoe);
				return $filas;
			}
			elseif(!$pedidoe){
				return $this->lastfilas;
			}
			else{
				return -2;
			}
		}
		else{
			return -1;
		}
	}
	
	public function setTable($tablabd){
		$this->tabla=$tablabd;
		return 0;
	}
	
	public function setTableReport($tablarep){
		$this->tablareport=$tablarep;
		return 0;
	}
	
	public function setBD($bd){
		$this->bd=$bd;
		return 0;		
	}
	
	public function setServer($serveridor){
		$this->servidor=$serveridor;
		return 0;
	}
	
	public function setPort($puertobd){
		$this->puerto=$puertobd;
		return 0;
	}
	
	public function setUsuario($usuariobd){
		$this->usrbd=$usuariobd;
		return 0;
	}
	
	public function setClaveUsuario($claveusr){
		$this->contbd=$claveusr;
		return 0;
	}
	
	public function setSentence($sentence){
		$this->lastcons=$sentence;
		return 0;
	}
	
	public function getSentence(){
		return $this->lastcons;
	}
	
	//////////////////////////////////////////////////////
	
	public function getTable(){
		return $this->tabla;
	}
	
	public function getBD(){
		return $this->bd;
	}
	
	public function getServer(){
		return $this->servidor;
	}
	
	public function getPort(){
		return $this->puerto;
	}

	public function getUsuario(){
		return 	$this->usrbd;
	}
	
	public function getClaveUsuario(){
		return $this->contbd;
	}
	
	//////////////////////////////////////////////////////
/*
 * 	protected $nomlogin;
	protected $clavelogin;
	protected $nivellogin;
	protected $mdclavlogin;
	protected $tablaulogin;
 * */
	function setCampNomLogin($camponom){
		$this->nomlogin=$camponom;
		return 0;
	}
	
	function setCampClaveLogin($clavenom){
		$this->clavelogin=$clavenom;
		return 0;
	}
	
	function setCampNivelLogin($nivelnom){
		$this->nivellogin=$nivelnom;
		return 0;
	}
	
	function setTablaLogin($tablogin){
		$this->tablaulogin=$tablogin;
		return 0;
	}
	
	function setNivelAdmin($nivadm){
		$this->niveladmin=$nivadm;
		return 0;	
	}

	function setNivelUsuario($nivusr){
		$this->nivelusuario=$nivusr;
		return 0;
	}
	
	//////////////////////////////////////////////////////////////////////
	function getCampNomLogin(){
		return $this->nomlogin;
	}
	
	function getCampClaveLogin(){
		return $this->clavelogin;
	}
	
	function getCampNivelLogin(){
		return $this->nivellogin;
	}
	
	function getTablaLogin(){
		return $this->tablaulogin;
	}
	
	function getNivelAdmin(){
		return 	$this->niveladmin;
	}

	function getNivelUsuario(){
		return $this->nivelusuario;
	}
	//////////////////////////////////////////////////////////////////////
	
	function LoginUncripted($usuariovl,$clavevl){
		$conn=$this->conexion;	
		//realizar la consulta de login
		$camponom=$this->nomlogin;
		$clavenom=$this->clavelogin;
		$nivelnom=$this->nivellogin;
		$tablogin=$this->tablaulogin;
		$nivadm=$this->niveladmin;
		$nivusr=$this->nivelusuario;
		
		$sel="SELECT * FROM ".$tablogin." WHERE ".$camponom."='".$usuariovl."' AND ".$clavenom."='".$clavevl."'";
		$pedido=mysql_query($sel,$conn);
		
		if($pedido){
			$filas=mysql_num_rows($pedido);
			if($filas>0){
				$_SESSION['usuario']=$usuariovl;
			}
		}
	}
	
	function LoginEncriptedMD5($usuariovl,$clavevl){
		//realizar la consulta de login
		$conn=$this->conexion;	
		//realizar la consulta de login
		$camponom=$this->nomlogin;
		$clavenom=$this->clavelogin;
		$nivelnom=$this->nivellogin;
		$tablogin=$this->tablaulogin;
		$nivadm=$this->niveladmin;
		$nivusr=$this->nivelusuario;
		
		$sel="SELECT * FROM ".$tablogin." WHERE ".$camponom."='".$usuariovl."' AND ".$clavenom."='".md5($clavevl)."'";
		$pedido=mysql_query($sel,$conn);
		
		if($pedido){
			$filas=mysql_num_rows($pedido);
			if($filas>0){
				$_SESSION['usuario']=$usuariovl;
			}
		}
	}
	
	function setCollate($collate){
		$this->collationbd=$collate;
	}

	function setChrSet($charset){
		$this->charsetbd=$charset;	
	}

	function getCollate(){
		return $this->collationbd;
	}

	function getChrSet(){
		return $this->charsetbd;	
	}
	
	function CreateBD($bd){
		//realizar la asignacion de conexion
		$conn=$this->conexion;
		$charset=$this->charsetbd;
		$collate=$this->collationbd;
				
		if($conn!=''){
			if($charset!=''){
				if($collate!=''){
					$q="CREATE DATABASE ".$bd." CHARACTER SET '".$charset."' COLLATE '".$collate."'";
					$pedido=mysql_query($q,$conn);
					if($pedido){
						return 0;
					}
					else{
						return -1;
					}
				}
				else{
					$this->printCad("No EXISTE CODIUFICACION DE LA TABLA");
				}
			}
			else{
				$this->printCad("No EXISTE CHARSET");
			}
		}
		else{
			$this->printCad("No EXISTE CONEXION CON LA BD");
		}
	}
	
	function CreateTable($tabla){
		if($tabla!=''){
			$this->lastablemk=$tabla;
			return new tbl();
		}
		else{
			return -1;
		}
	}
	
	function getMkLastTable(){
		if($this->lastablemk!=''){
			return $this->lastablemk;
		}
		else{
			return -1;
		}
	}
	
	function ScanDir($dir){
		$dh  = opendir($dir);
		while (false !== ($filename = readdir($dh))) {
		    $files[] = $filename;
		}
		
		sort($files);
		rsort($files);
		
		return $files;
	}

	function ScanDir_p($dir){
		$dh  = opendir($dir);
		while (false !== ($filename = readdir($dh))) {
		    $files[] = $filename;
		}
		sort($files);
		print_r($files);
		rsort($files);
		print_r($files);
	}
	
	//TABLA CAMPOS VALUES Mejorada!!!!!!!!!!!!!!!!!!!!!!!!!...y Funciona!
	function InsertInto_str(){
		$conn=$this->conexion;
		$numargs = func_num_args();
	    $argulist = func_get_args();
	    $camposins=array();
	    $valoresins=array();
	    $camposreal=array();
	    $this->numvalins=0;
	    $this->numcamins=0;
	    if($conn){
	    	//ver si existe campo
	    	$tablai=$argulist[0];
	    	for($u=1;$u<$numargs;$u++){
    			$base=$this->bd;
				$retfunc=$this->isCampo($tablai,$argulist[$u]);
				///////////RETFUNC (lo que devuelve);
		    	if($retfunc==-1){
		    		$valoresins[]=$argulist[$u];
					$this->numvalins++;
		    	}
		    	
		    	if($retfunc==0){
		    		$camposins[]=$argulist[$u];
		    		$this->numcamins++;
		    	}
	    	}
	    	if($this->numvalins==$this->numcamins){
		    	$selins="INSERT INTO ".$tablai."(";
				for($r=0;$r<=$this->numcamins-1;$r++){
					if($r<($this->numcamins-1)){
						$selins.=$camposins[$r].",";
					}
					elseif($r==($this->numcamins)){
						$selins.=$camposins[$r].')';
					}
					else{
						$selins.=$camposins[$r].') VALUES(';
						break;
					}
				}
				
		    	for($r=0;$r<=$this->numvalins;$r++){
					if($r<($this->numvalins-1)){
						$selins.="'".$valoresins[$r]."',";
					}
					elseif($r==($this->numvalins)){
						$selins.=$valoresins[$r].')';
					}
					else{
						$selins.="'".$valoresins[$r]."')";
						break;
					}
				}
				return $selins;
	    	}
	    	else{
				$this->nderror="La cantidad de campos y valores es desigual!";
	    	}
	    }
	    else{
			$this->nderror="ERROR -1: NO HAY CONEXION";
	    }
	}
	
	function isCampo($tabla,$campo){
		$fieldsa=array();
		$conn=$this->conexion;
		if($conn){
			if($tabla!='' && $this->bd!='' && $campo!=''){
				$base=$this->bd;
			}
			else{
				return -1;
			}
			
			$query="SELECT * FROM ".$tabla;
			
			if($query!=''){
				$pedaux=mysql_query($query,$conn);
			}
			else{
				$pedaux=mysql_query($this->lastcons,$conn);
			}
			
			if($pedaux){
				if($query!=''){
					$this->lastcons=$query;
					$this->lastfilas=mysql_num_rows($pedaux);
					$numfields=mysql_num_fields($pedaux);

					
					for($i=0;$i<$numfields;$i++){
						$fieldsa[]=mysql_field_name($pedaux,$i);
					}
					for($i=0;$i<$numfields;$i++){
						if($campo==$fieldsa[$i]){
							$camporesult=$fieldsa[$i];
							break;
						}
					}
					
					if(	$camporesult!=''){
						return 0;
					}
					else{
						return -1;
					}
				}
				else{
					$this->lastcons=$query;
					$this->lastfilas=mysql_num_rows($pedaux);
					$numfields=mysql_num_fields($pedaux);

					
					for($i=0;$i<$numfields;$i++){
						$fieldsa[]=mysql_field_name($pedaux,$i);
					}
					
					for($i=0;$i<$numfields;$i++){
						if($fieldsa[$i]==$campo){
							$camporesult=$fieldsa[$i];
							break;
						}
					}
					
					if(	$camporesult!=''){
						return 0;
					}
					else{
						return -1;
					}			
				}
			}
			else{
				$error="<h3>".mysql_error()."</h3>";
				return $error;
			}
		}
		else{
			return -1;
		}
	}
}
?>
