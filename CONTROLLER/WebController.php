<?php 

    class WebController { 

         public function getCadastro() { 
            include "VIEW/registrar.php";
         }   
         
         public function getArvore() { 
            include "VIEW/visualizar.php";    
         }

         public function getPontos() { 
            include "VIEW/alterar.php";
         }
 
         

    }

?> 