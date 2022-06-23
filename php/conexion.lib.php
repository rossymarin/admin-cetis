<?PHP
	class Conexion{
		private $cnn;

		function open(){
			$this->cnn = new mysqli("localhost", "root", "root", "login");
			if (mysqli_connect_errno()){
                echo '<p class="">';
                exit();
            }
		}

		function select($qry){
			$co = $this->cnn;
			$res = $co->query($qry);
			return $res;
		}
	}
?>