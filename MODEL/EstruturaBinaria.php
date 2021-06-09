<?php

    /* 
        Como cadastrar os usuários 

            O primeiro Usuário 


    */

    class EstruturaBinaria { 

        private $id; // ID da Árvore 
        private $nome; //Nome du Usuario; 
        private $pontos; //Pontos do Usuario 
        private $direcao; //Esquerda ou Direita

        public function __construct() { 
            //ainda esta vazio; 
        }

        
        //Funções GETTERS
        public function getId() {
            return $this->id;
        }

        public function getNome() {
            return $this->nome; 
        }

        public function getPontos() { 
            return $this->pontos; 
        }

        public function getEsquerda() { 
            return $this->esquerda;
        }

        public function getDireita() { 
            return $this->direita; 
        }

        //Funções SETTERS 
        public function setId($id) {
            $this->id = $id;
        }

        public function setNome($nome) {
            $this->nome = $nome;
        }

        public function setPontos($pontos) {
            $this->pontos = $pontos;
        }

        public function setEsquerda($esquerda) {
            $this->esquerda = $esquerda;
        }

        public function setDireita($direita) { 
            $this->direita = $direita;
        }

        public function countTotal() { 

            //Faz a Consulta para Teste 
            $query = "
            SELECT COUNT (node_id) as total 
            	FROM tb_node
            ";

            $conexao = Conexao::abreConexao(); 
            $result = $conexao->query($query);
            $linha = $result->fetch(); 

            return $linha; 

        }

        public function lerUltimoRegistro() { 
            
            $query = "SELECT MAX(node_id) as maximo FROM tb_node"; 

            $conexao = Conexao::abreConexao(); 

            $result = $conexao->query($query);
            $linha = $result->fetch(); 

            return $linha; 
            
        }

        public function inserirNo() { 

            $teste = $this->countTotal(); 
                if($teste['total'] == 0) { 
                    $query = "INSERT INTO tb_node usuario, parent_id VALUES (:usuario, :parent_id)"; 

                    //Abre a Conexão 
                    $conexao = Conexao::abreconexao();
                    $stmt = $conexao->prepare($query); 
                    $stmt->bindValue(':usuario', $this->getNome());
                    $stmt->bindValue(':parent_id', 0);
                    $stmt->execute(); //Executa o Insert 

                    $conexao = Conexao::fechaConexao(); 
                } else { 
                    $query = "INSERT INTO tb_node usuario VALUES (:usuario)"; 

                    //Abre a Conexão
                    $conexao = Conexao::abreconexao();
                    $stmt = $conexao->prepare($query); 
                    $stmt->bindValue(':usuario', $this->getNome());
                    $stmt->execute(); //Executa o Insert 

                    $conexao = Conexao::fechaConexao(); 

                    //Busca Máximo 
                    $maximo = $this->lerUltimoRegistro(); 
                      $resultado = $maximo['maximo'] % 2; 
                        if($resultado == 0) { 
                            $pid = INTDIV($maximo,2); 
                            $dire = "esquerda"; 

                            $update = "
                                UPDATE tb_node
                                SET parent_id= $pid,  direcao=$dire, 
                                WHERE node_id = $maximo";

                          
                            $conexao = Conexao::abreconexao(); 
                            $stmt = $conexao->prepare($update);
                            $stmt->execute(); 

                            $conexao = Conexao::fechaConexao(); 
    
                        } else { 
                            $pid = INTDIV($maximo,2); 
                            $dire = "direita"; 

                            $update = "
                                UPDATE tb_node
                                SET parent_id= $pid,  direcao=$dire, 
                                WHERE node_id = $maximo";

                          
                            $conexao = Conexao::abreconexao(); 
                            $stmt = $conexao->prepare($update);
                            $stmt->execute(); 

                            $conexao = Conexao::fechaConexao(); 
                        }
                          
                }        
              
        }

        public function listarRegistro($id) { 
            $query = "SELECT * FROM tb_node WHERE node_id = $id";

            $conexao = Conexao::abreConexao(); 

            $result = $conexao->query($query);
            $linha = $result->fetch(); 

            return $linha; 
               
        }

        public function listarUltimoParent() { 
            $query = "
                SELECT parent_id FROM tb_node 
                WHERE node_id = (SELECT max(node_id) FROM tb_node"; 

                $conexao = Conexao::abreConexao(); 

                $result = $conexao->query($query);
                $linha = $result->fetch(); 
    
                return $linha; 
        }

        public function listarTodosRegistros() { 
            
            $query = "
            SELECT * FROM tb_node"; 
            
            $conexao = Conexao::abreConexao(); 

            $result = $conexao->query($query);
            $lista = $result->fetchAll(); 

            return $lista; 
        
        }



        //Registra os pontos do Usuario         
        public function registrarPontos($id) { 
            
            $numero = $this->listarRegistro($id); 
                $resultado = $numero['node_id'] % 2; 
                    
                    if($resultado == 0) { //numero par
                          $query = "
                             UPDATE tb_node SET pontos_esq = :pontos_esq
                             WHERE node_id = :node_id                           
                          ";  

                          $conexao = Conexao::abreconexao();
                          $stmt = $conexao->prepare($query); 
                          $stmt->bindValue(':pontos_esq', $this->getPontos());
                          $stmt->bindValue(':node_id', $this->getId()); 
                          $stmt->execute(); //Executa o Insert 

                          //Fecha a Conexão 
                          $conexao = Conexao::fechaConexao();  
                                
                            $pid = $numero['parent_id']; 

                            //Passa os mesmos pontos para o Nó Pai 
                            $updatePai = "UPDATE tb_node SET pontos_esq = :pontos_esq 
                            WHERE node_id = $pid"; 

                            $conexao = Conexao::abreconexao();
                            $stmt = $conexao->prepare($updatePai); 
                            $stmt->bindValue(':pontos_esq', $this->getPontos());
                            $stmt->execute(); //Executa o Insert 

                    } else { //Número Impar 
                            $query = "
                            UPDATE tb_node SET pontos_esq = :pontos_dir
                            WHERE node_id = :node_id                           
                        ";  

                        $conexao = Conexao::abreconexao();
                        $stmt = $conexao->prepare($query); 
                        $stmt->bindValue(':pontos_dir', $this->getPontos());
                        $stmt->bindValue(':node_id', $this->getId()); 
                        $stmt->execute(); //Executa o Insert 

                        //Fecha a Conexão 
                        $conexao = Conexao::fechaConexao();  
                            
                        $pid = $numero['parent_id']; 

                        //Passa os mesmos pontos para o Nó Pai 
                        $updatePai = "UPDATE tb_node SET pontos_dir = :pontos_dir 
                        WHERE node_id = $pid"; 

                        $conexao = Conexao::abreconexao();
                        $stmt = $conexao->prepare($updatePai); 
                        $stmt->bindValue(':pontos_esq', $this->getPontos());
                        $stmt->execute(); //Executa o Insert 

                    } 
            
            }


    }

?> 