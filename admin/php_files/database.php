<?php
class Database{
    private $db_host = "localhost";
    private $db_user = "root";
    private $db_pass = "";
    private $db_name = "e-commerce_db";

    private $mysqli = "";
    private $myQuery = "";
    private $result = array();
    private $conn = false;

    // Method for Create Database Connection

    function __construct() {
        if(!$this->conn) {
            $this->mysqli = new mysqli($this->db_host,$this->db_user,$this->db_pass,$this->db_name);
            $this->conn = true;

            if($this->mysqli->connect_error) {
                array_push($this->result, $this->mysqli->connect_error);
                return false;
            }
        } else {
            return true;
        }
    }

    // Method for Insert Record into Database with Table Name (INSERT)

    function insertDB($table, $params = array()) {
        if($this->tableExist($table)) {
            $table_columns = implode(', ', array_keys($params));
            $table_values = implode("', '", $params);
            $sql = "INSERT INTO $table ($table_columns) VALUES ('$table_values')";
            if($this->mysqli->query($sql)) {
                array_push($this->result, $this->mysqli->insert_id);
                return true;
            } else {
                array_push($this->result, $this->mysqli->error);                
                return false;
            }
        } else {
            return false;
        }
    }

    // Method for Update Record (UPDATE)

    function updateDB($table, $params = array(), $where = null) {
        if($this->tableExist($table)) {
            $args = array();
            foreach($params as $key => $value) {
                $args[] = "$key = '$value'";
            }
            
            $sql = "UPDATE $table SET ". implode(', ', $args);
            if($where != null) {
                $sql .= " Where $where";
            }

            if($this->mysqli->query($sql)) {
                array_push($this->result, $this->mysqli->affected_rows);
                return true;
            } else {
                array_push($this->result, $this->mysqli->error);
                return false;
            }
        } else {
            return false;
        }
    }

    // Method for Delete Record (DELETE)

    function deleteDB($table, $where = null) {
        if($this->tableExist($table)) {
            $sql = "DELETE FROM $table";
            if($where != null) {
                $sql .= " WHERE $where";
            }
            if($this->mysqli->query($sql)) {
                array_push($this->result, $this->mysqli->affected_rows);
                return true;
            } else {
                array_push($this->result, $this->mysqli->error);
                return false;
            }
        } else {
            return false;
        }
    }

    // Method for Display Table Records (SELECT)        

    function select($table, $rows = "*", $join = null, $where = null, $order = null, $limit = null) {
        if($this->tableExist($table)) {
            $sql = "SELECT $rows FROM $table";
            if($join != null) {
                $sql .= ' JOIN '.$join;
            }
            if($where != null) {
                $sql .= ' WHERE '.$where;
            }
            if($order != null) {
                $sql .= ' ORDER BY '.$order;
            }
            if($limit != null) {
                if(isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                $start = ($page - 1) * $limit;
                $sql .= ' LIMIT '.$start.','.$limit;
            }
            
            $this->myQuery = $sql; // Pass the sql to check it

            $query = $this->mysqli->query($sql);
            if($query) {
                $this->result = $query->fetch_all(MYSQLI_ASSOC);
                return true;
            } else {
                // array_push($this->result, $this->mysqli->error);                
                $this->result = array();
                return false;
            }
        } else {
            return false;
        }
    }

    // Method to Display the data with Pagination (Pagination)

    function pagination($table, $join = null, $where = null, $limit = null, $link = null) {        
        if($this->tableExist($table)) {
            if($limit != null) {
                $sql = "SELECT COUNT(*) FROM $table";
                if($join != null) {
                    $sql .= " JOIN $join";
                }
                if($where != null) {
                    $sql .= " WHERE $where";
                }

                $query = $this->mysqli->query($sql);
                $total_record = $query->fetch_array();
                $total_record = $total_record[0];

                $total_page = ceil($total_record / $limit);
                $url = basename($_SERVER['PHP_SELF']);

                if(isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }                

                $output = "<ul class = 'pagination'>";

                if($page > 1) {
                    if($link != null) {
                        $output .= "<li><a href='$url".$link."&page=".($page - 1)."'>Prev</a></li>";
                    } else {
                        $output .= "<li><a href='$url?page=".($page - 1)."'>Prev</a></li>";
                    }
                }

                if($total_record > $limit) {
                    for($i = 1; $i <= $total_page; $i++) {
                        if($i == $page) {
                            $cls = "class='active'";
                        } else {
                            $cls = "";
                        }
                        if($link != null) {
                            $output .= "<li><a href='$url".$link."&page=$i'>$i</a></li>";
                        } else {
                            $output .= "<li><a href='$url?page=$i'>$i</a></li>";
                        } 
                    }
                }

                if($total_page > $page) {
                    if($link != null) {
                        $output .= "<li><a $cls href='$url".$link."&page=".($page + 1)."'>Next</a></li>";
                    } else {
                        $output .= "<li><a $cls href='$url?page=".($page + 1)."'>Next</a></li>";
                    }
                }

                $output .= "</ul>";
                echo $output;

            } else {
                return false;
            }            
        }
    }

    // Method to check The table is Exist or Not

    private function tableExist($table) {
        $sql = "SHOW TABLES FROM `$this->db_name` LIKE '$table'";
        $tableIndb = $this->mysqli->query($sql);
        if($tableIndb) {
            if($tableIndb->num_rows == 1) {
                return true;
            } else {
                array_push($this->result, $table." does not exist in this Database");
                return false;
            }
        }
    }   

    // Method to Return the Data to the User

    function getResult() {
        $val = $this->result;        
        $this->result = array();
        return $val;
    }

    //Method to Pass the SQL back for debugging
    
    function getSql() {
        $val = $this->myQuery;        
        $this->myQuery = array();
        return $val;
    }

    // Method for Escape String

    function escapeString($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $this->mysqli->real_escape_string($data);
    }

    // Method for Close the Connection

    function __destruct() {
        if($this->conn) {
            if($this->mysqli->close()) {
                $this->conn = false;                
                return true;
            }
        } else {
            return false;
        }
    }    

}

?>