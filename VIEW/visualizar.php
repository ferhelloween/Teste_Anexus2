<?php

    //Criando o arquivo de visualização da árvore 

    $view = new EstruturaBinaria(); 

            $number = $view->listarUltimoParent(); 

            $lista = $view->listarTodosRegistros();

                $resultado = INTDIV($number['parent_id'], 2); 
                $colunas = $number['parent_id'] + 1; 


?> 

<table class="table">
    <?php 
        for($i = 0; $i < $resultado; $i++) { 
            echo "<tr>";             
                for($j = 0; $j <= $colunas; $j++) { 
                    $rowspan = $resultado/pow(2,$j+1);
                         if(0 === $i%$rowspan) {
                            echo "<td rowspan=".$rowspan.">
                              <form accept-charset='UTF-8' method='POST>'
                              <input type='hidden' name='idnode' value='".$lista['node_id']."'>
                              <button type='submit' formaction='?page=atuNo' class='btn btn-link btn-xs'>   
                            ".$lista['parent_id']."</button></td>";
                         }       
                }
            echo "</tr>";    
        }
    ?>



</table>