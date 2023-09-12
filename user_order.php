    <?php 
    error_reporting(0);
     // $qq = "Select * FROM (select a.*, (select count(order_id) from `order` where users_system_id = a.users_system_id and created_at >= '$twoMonthDate') as count,"
            // ." (select created_at,users_system_id from `order` where users_system_id = a.users_system_id order by created_at desc limit 1) as last_order_date from users_system as a "
            // ." WHERE 1 ". $searchQuery  . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage .") x where x.count = 0 $dateOrderBy";
    class DB{
        public $link;
        function __construct(){
            $this->link = mysqli_connect('localhost', 'mjcoderscom_sauce_pan_user', '8ao~h9Gn-~1t', 'mjcoderscom_sauce_pan');
            if (!$this->link) {
                echo "Error: Unable to connect to MySQL." . PHP_EOL;
                echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
                echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
                exit;
            }
        }
        public function fetchall(){
            $draw = $_POST['draw'];
            $row = $_POST['start'];
            $rowperpage = $_POST['length']; // Rows display per page
            $columnIndex = $_POST['order'][0]['column']; // Column index
            $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
            $dateOrderBy = '';
            if ($columnName == "name") {
                $columnName = "first_name";
            }
           
            if ($columnName == "phone") {
                $columnName = "mobile";
            }
            if ($columnName == "count") {
                $columnName = "users_system_id";
            }
            if ($columnName == "date") {
                $columnName = "last_order_date";
            }
            $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
            $searchValue = $_POST['search']['value']; // Search value
            ## Search 
            $searchQuery = " ";
            if ($searchValue != '') {
                $searchQuery = " and (first_name like '%" . $searchValue . "%' or last_name like '%" . $searchValue . "%' or 
                    email like '%" . $searchValue . "%' ) ";
            }
            $twoMonthDate = date("Y-m-d h:i:s", strtotime(" -2 months"));
            $today = date('Y-m-d h:i:s');
            // TOTAL RECORDS
            $totalRecords = mysqli_num_rows(mysqli_query($this->link,"select b.created_at as last_order_date,a.users_system_id,c.count as count from users_system as a "
            ."left join (select MAX(created_at) as created_at,users_system_id From (select created_at,users_system_id from `order` order by created_at desc) as x group by users_system_id) as b ".
            " on a.users_system_id = b.users_system_id ".
            "left join (select count(order_id) as count ,users_system_id from `order` where created_at >= '$twoMonthDate' group by users_system_id ) as c".
            " on a.users_system_id = c.users_system_id"
            ." WHERE ( count IS NULL )  AND b.created_at <= '$twoMonthDate' AND b.created_at IS NOT NULL"));
            if(!$totalRecords){
                return "Error: Unable to count data ";
            }
            
            
            $totalRecordwithFilter = 0;
        //   GET DATA
            $sql = "select a.*,b.created_at as last_order_date, c.count as count from users_system as a "
            ."left join (select MAX(created_at) as created_at,users_system_id From (select created_at,users_system_id from `order` order by created_at desc) as x group by users_system_id) as b ".
            " on a.users_system_id = b.users_system_id ".
            "left join (select count(order_id) as count ,users_system_id from `order` where created_at >= '$twoMonthDate' group by users_system_id ) as c".
            " on a.users_system_id = c.users_system_id"
            ." WHERE ( count IS NULL ) AND b.created_at <= '$twoMonthDate' AND b.created_at IS NOT NULL ". $searchQuery  . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage ."";
            // echo $sql;
            $query = mysqli_query($this->link,$sql);
            // FILTER RECORD COUNT
            $sqlCount = "select count(a.users_system_id) as c,b.created_at as last_order_date,a.users_system_id,c.count as count from users_system as a "
            ."left join (select MAX(created_at) as created_at,users_system_id From (select created_at,users_system_id from `order` order by created_at desc) as x group by users_system_id) as b ".
            " on a.users_system_id = b.users_system_id ".
            "left join (select count(order_id) as count ,users_system_id from `order` where created_at >= '$twoMonthDate' group by users_system_id ) as c".
            " on a.users_system_id = c.users_system_id"
            ." WHERE ( count IS NULL )  AND b.created_at <= '$twoMonthDate' AND b.created_at IS NOT NULL ". $searchQuery  . " order by " . $columnName . " " . $columnSortOrder;
            // count IS NOT NULL AND 
            $queryCount = mysqli_query($this->link,$sqlCount);
            $totalRecordwithFilter = mysqli_fetch_array($queryCount)['c'];
            
            $tabledata = [];
            while ($user = mysqli_fetch_assoc($query)) {
                $data = [];
                $data["users_system_id"] = $user['users_system_id'];
                $data["name"] = $user['first_name'] . " " . $user['last_name'];
                $data["phone"] = $user['mobile'];
                $data["email"] = $user['email'];
                $data["date"] = empty($user['last_order_date'])? 'no order': $user['last_order_date'];
                $d["user"] = ["users_system_id" => $user['users_system_id']];
                $d["count"] = $user['users_system_id'];
                $tabledata[] = $data;
            }
            // print_r($tabledata);
            $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecordwithFilter,
                "aaData" => $tabledata,
                // 'query'=>$sqlCount,
                'query2'=>$sql,
            );

            return $response;
               
            }
       
        
    }
    
    $cssScriptDir = "https://cdn.datatables.net/1.11.3/";
        
?>
<?php
    if($_GET['order']){
        $db = new DB();
        $data = $db->fetchall();
        echo json_encode($data);
        exit();
    }
?>
<html>
    
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link href="<?php echo $cssScriptDir;?>css/jquery.dataTables.min.css" rel="stylesheet">
        <style>
            body{
                max-width:100%;
            }
            .table-container{
                max-width: 100%;
                padding: 20px;
            }
            .dataTables_wrapper .dataTables_paginate .paginate_button:hover{
                border:none;
                background: linear-gradient(to bottom, #337ab7 0%, #337ab74f 100%);
            }
        </style>
    </head>
    <body>
        <div class='table-responsive table-container'>
            <table class="table table-bordered table-striped table-hover dataTables-example" id = "userTable2">
                <thead>
                    <tr>
                        <th>#</th>
                    	<th>name</th>
                    	<th>email</th>
                    	<th>last_order</th>
                    	<th>phone</th>
                    </tr>
                </thead>
                                           
            </table>
        </div>
         
       
        <script src="<?php echo $cssScriptDir;?>js/jquery.dataTables.min.js"></script>
        <script src="<?php echo $cssScriptDir;?>js/dataTables.bootstrap4.min.js"></script>
        <script>
            $(document).ready(function(){
               $('#userTable2').DataTable({
                  'processing': true,
                  'serverSide': true,
                  'serverMethod': 'post',
                  'ajax': {
                      'url':'user_order.php?order=true'
                  },
                  'columns': [
                      { data: 'users_system_id' },
                     { data: 'name' },
                     { data: 'email' },
                     { data: 'date' },
                     { data: 'phone' },
                  ]
               });
            });
        </script>
    </body>
</html>