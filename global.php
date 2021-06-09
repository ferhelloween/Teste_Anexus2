<?php 

    require_once "MODEL/Config.php"; 

        spl_autoload_register('carregarModel'); 

            function carregarModel($nomeModel) { 
                require_once 'MODEL/'.$nomeModel.'.php';   
            }


?> 