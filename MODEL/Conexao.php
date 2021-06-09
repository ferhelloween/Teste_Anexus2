<?php 

    include "Config.php"; 

        class Conexao { 

            public static function abreConexao() { 
                $sql = new PDO('pgsql:host='.DB_HOSTNAME.';port=5432; dbname='.DB_DATABASE.';user='.DB_USERNAME.';password='.DB_PASSWORD.';');
                $sql->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $sql->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING); 
                
                return $sql; 
            }

            public static function fechaConexao() {
                $sql = null; 

                return $sql;
            }


        }


?> 