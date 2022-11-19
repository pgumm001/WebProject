<?php 
    require_once 'init.php';
    require 'vendor/autoload.php';
    error_reporting(E_ERROR | E_PARSE);
    use Elastic\Elasticsearch\ClientBuilder;

    $client = ClientBuilder::create()
    ->setHosts(['localhost:9200'])
    ->build();

    $response = $client ->info();
//     'query' =>[
//         'bool' =>[
//             'should' =>[
//                 'match'=>['caption'=> $q]
//             ]
//         ]
//     ]
// ]
    if(isset($_GET['search'])) {
        $q = $_GET['search'];
        $query = $client->search([
            'body' => [
                'size' => 2000,
                'query' =>[
                    'bool' =>[
                        'should' =>[
                            'match'=>['caption'=> $q]
                        ]
                    ]
                ]
            ]
        ]);
      
        if($query['hits']['total']>=1){
            $results = $query['hits']['hits'];
            $total = $query['hits']['total']['value'];
        }
        // print_r($total);


    }
    ?>
    <div class="dataTable">
    <h2 id="count">Results Found <?php print_r($total) ?></h2>
        <table>
            <tr>
                    <th>Figure ID</th>
                    <th>Compound fig</th>
                    <th>Caption</th>
                    
            </tr>
            <?php
                if (isset($results)){
                    foreach ($results as $r){
                        $path = "compound_test2007/".$r['_source']['figure_file'];
                        // echo $path;

                    ?>
                    <tr>
                    <!-- compound_test2007/USD0543554-20070529-D00001.png -->
                       <td> <?php  echo $r['_source']['figure_file'] ?></td>
                       <!-- <td><img src="compound_test2007/"+ <?php echo $r['_source']['figure_file'] ?>> </td> -->
                       <td><img style="width:40%;height:30%;" src=<?php echo $path ?>> </td>
                       <td> <?php  echo $r['_source']['caption'] ?></td>
                    </tr>
                    <?php
                        $q='';
                    }
                }

            ?>

</table> 

------------$_COOKIE
<?php 
    require_once 'init.php';
    require 'vendor/autoload.php';
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
   
    error_reporting(E_ERROR | E_PARSE);
    include('config.php');
    $id = $_SESSION["user"]->id;
    echo $id;
    $grpIds = array();
    $q = $_POST['search'];
    $conn = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);
    // $sql = "select distinct(groupID) from USERS where id =$id";
    
    $sql = "select * from  figure_segmented_nipseval_test2007 where groupID in (select distinct(groupID) from USERS where id =$id) And ((@id is null or lower(object) like '%$q%')  or(@id is null or  lower(caption) like '%$q%') )";
    
    $result = mysqli_query($conn, $sql);  
    if (!$result) {
        echo "Wrong SQL Query: $sql";
        die;
    } else {
        // print_r($sql);
         print_r($result);
    }
    // if (mysqli_num_rows($result) > 0) {
               
    //     while($data = mysqli_fetch_assoc($result)) {
           
    //     }
    // }
    // print_r($grpIds);

    // use Elastic\Elasticsearch\ClientBuilder;

    // $client = ClientBuilder::create()
    // ->setHosts(['localhost:9200'])
    // ->build();

    // $response = $client ->info();
 
  
 

    // if($_POST['searchAnnotation']) {
    //     $q = $_GET['searchAnnotation'];
    //     $query = $client->search([
    //         'body' => [
    //             'size' => 2000,
    //                 'query'=> {
    //                     'query_string'=> {
    //                     'query'=> '(caption:$q OR object:$q) AND (groupID:'')'
    //                     }
    //                 }
                    
    //         ]
    //     ]);

        // if($query['hits']['total']>=1){
        //     $results = $query['hits']['hits'];
        //     $total = $query['hits']['total']['value'];
        // }
        // print_r($results);


    // }
    ?>
    <div class="dataTable">
    <!-- <h2>Results Found </h2> -->
     
            <?php
            // $total = 90;
                if (isset($results)){
                    foreach ($results as $r){
                        $path = "compound_test2007/".$r['_source']['figure_file'];
                        // echo $path;
                    ?>
                    
                    <tr>
                    <!-- compound_test2007/USD0543554-20070529-D00001.png -->
                       <td> <?php  echo $r['_source']['figure_file'] ?></td>
                       <!-- <td><img src="compound_test2007/"+ <?php echo $r['_source']['figure_file'] ?>> </td> -->
                       <td><img style="width:40%;height:30%;" src=<?php echo $path ?>> </td>
                       <td> <?php  echo $r['_source']['caption'] ?></td>
                    </tr>
                    <?php
                        
                    }
                }

            ?>

</table> 
