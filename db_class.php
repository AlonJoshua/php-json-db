<?php
    class JSON_DB 
    {

        public function __construct()
        {
            //  
        }

        public static function create_table($table_name, $table_content)
        {
            $json_content = json_encode($table_content);
            $file_name = $table_name.'.json';
            file_put_contents($file_name, $json_content);
        }

        public static function read_row($table_name, $index)
        {
            $file_name = $table_name.'.json';
            $table = json_decode(file_get_contents($file_name));
            $row = json_encode($table[$index]);
            echo($row);
        }


        public static function edit_row($table_name, $index, $value)
        {
            $file_name = $table_name.'.json';
            $table = json_decode(file_get_contents($file_name));
            $table[$index] = $value;
            $table_encode = json_encode($table);
            file_put_contents($file_name, $table_encode);
        }

        public static function delete_row($table_name, $index) 
        {
            $file_name = $table_name.'.json';
            $table = json_decode(file_get_contents($file_name));
            unset($table[$index]);
            $table_encode = json_encode($table);
            file_put_contents($file_name, $table_encode);
        }

    }

    class EXPORT_DB 
    {
        public function __construct()
        {
            //  
        }
        
        public static function export_table_with_values($table_name, $filtered_columns)
        {
            $file_name = $table_name.'.json';
            $table = json_decode(file_get_contents($file_name));
            $filtered_table = self::filtered_columns($table, $filtered_columns);
            echo json_encode($filtered_table);
        }
        private static function filtered_columns($table, $filtered_columns) 
        {
            $new_table = array();
            foreach ($table as $key=>$value) {
                $new_row = array();
                foreach ($filtered_columns as $column) {
                    $new_row[$column] = $table[$key]->$column;
                }
                $new_table[$key] = $new_row;
            }
            return $new_table;
        }
    }

$users_table = Array (
    "0" => Array (
        "id" => "1",
        "name" => "alon",
        "subject" => "developer"
    ),
    "1" => Array (
         "id" => "2",
        "name" => "Dikla",
        "subject" => "HR"
    ),
    "2" => Array (
        "id" => "3",
       "name" => "Rafael",
       "subject" => "CEO"
    )
);

$products_table = Array (
    "0" => Array (
        "id" => "1",
        "title" => "marketing automation",
        "subject" => "services"
    ),
    "1" => Array (
         "id" => "2",
        "title" => "website development",
        "subject" => "wordpress"
    )
 );
 
// JSON_DB::create_table('users', $users_table);
// JSON_DB::read_row('users', 0);
// JSON_DB::edit_row('users', 1, $users_table[0]);
// JSON_DB::delete_row('users', 0);
// EXPORT_DB::export_table_with_values('users', ['name']);
?>