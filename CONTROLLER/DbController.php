<?php 

    class DbController { 

        public function registrarUser() { 
            
             $estrutura = new EstruturaBinaria(); 
             
             $estrutura->setNome($_REQUEST['nome']); 

             $estrutura->inserirNo(); 

             echo "<p>Inserido com sucesso <a href='index.php'>...Retorna a tela inicial </a></p>";

        }

        public function inserirPontos() { 

            $estrutura = new EstruturaBinaria(); 
             
            $estrutura->setId($_REQUEST['idnode']); 
            $estrutura->setPontos($_REQUEST['pontos']);

            $estrutura->registrarPontos($estrutura->setId($_REQUEST['idnode'])); 

            echo "<p>Pontos Inseridos <a href='index.php'>...Retorna a tela inicial </a></p>";


        }


    }


?> 