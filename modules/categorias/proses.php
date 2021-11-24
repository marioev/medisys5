
<?php
session_start();


require_once "../../config/database.php";

if (empty($_SESSION['username']) && empty($_SESSION['password'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
}

else {
    if ($_GET['act']=='insert') {
        if (isset($_POST['Guardar'])) {
            $categoria_nombre  = mysqli_real_escape_string($mysqli, trim($_POST['categoria_nombre']));
            $created_user = $_SESSION['id_user'];
            
            $query = mysqli_query($mysqli, "INSERT INTO categoria(categoria_nombre) 
                                            VALUES('$categoria_nombre')")
                                            or die('error '.mysqli_error($mysqli));
            if ($query) {
                header("location: ../../main.php?module=categorias&alert=1");
            }   
        }   
    }
    
    elseif ($_GET['act']=='update') {
        if (isset($_POST['Guardar'])) {
            if (isset($_POST['categoria_id'])) {
                $categoria_nombre  = mysqli_real_escape_string($mysqli, trim($_POST['categoria_nombre']));
                $categoria_id  = mysqli_real_escape_string($mysqli, trim($_POST['categoria_id']));
                //$updated_user = $_SESSION['id_user'];

                $query = mysqli_query($mysqli, "UPDATE categoria SET  categoria_nombre = '$categoria_nombre'
                                                              WHERE categoria_id       = '$categoria_id'")
                                                or die('error: '.mysqli_error($mysqli));

    
                if ($query) {
                  
                    header("location: ../../main.php?module=categorias&alert=2");
                }         
            }
        }
    }

    elseif ($_GET['act']=='delete') {
        if (isset($_GET['id'])) {
            $codigo = $_GET['id'];
      
            $query = mysqli_query($mysqli, "DELETE FROM categoria WHERE categoria_id='$codigo'")
                                            or die('error '.mysqli_error($mysqli));


            if ($query) {
     
                header("location: ../../main.php?module=categorias&alert=3");
            }
        }
    }       
}       
?>