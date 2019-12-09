<?php 
    function url_data($x){
		if(isset($_GET[$x])){
			return protect_data($_GET[$x]);
		}elseif(isset($_POST[$x])){
			return protect_data($_POST[$x]);
		}else{
			return null;
		}
    }
    function protect_data($x){
        return htmlspecialchars($x);
    }
?>