<?php
//  echo"inside delete"
    // header('Content-Type: application/json');
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL); 
    include('config.php');
     $id = $_POST['id'];
     $grpId = $_POST['grp'];
     $email = $_POST['email'];
     echo ($id);
     echo ($grpId);
     echo "inside approve";
    $conn = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);
    $sql = "update USERS set approved = 1 , groupID = $grpId where id =$id";
    $result = mysqli_query($conn, $sql);    

    $sql2 = "select patentID,object,figure_file,group_concat(subfigure_file) as subFile,object_title,groupID from figure_segmented_nipseval_test2007 where groupID =$grpId  group by figure_file";
    $result2 = mysqli_query($conn, $sql2);   
    $arr = array();
    $body = array();
    $curDate = date("Y/m/d") ;
    $curTime = time();
    $subFigArr = array();
    echo "test--------------";
    
    $dateTime = $curDate . $curTime;


    while($data = mysqli_fetch_assoc($result2)) {
        // echo $data['figure_file'];
       array_push($arr,$data['figure_file']);
        array_push($subFigArr,$data['subFile']);
    }


    echo "the total count is";
    echo $arr[1];

        require_once 'init.php';
        require 'vendor/autoload.php';
        
        use Elastic\Elasticsearch\ClientBuilder;
    
        $client = ClientBuilder::create()
        ->setHosts(['localhost:9200'])
        ->build();
    
        // $response = $client ->info();
        // print_r($response);
        $assignment = array('assign_id' => $grpId , 'user_id' => $email ,'date'=> $dateTime);
        
        for ($i=0;$i<count($arr);$i++){
           $array = array( "compoundfigure_file"=>$arr[$i] , "assignments" =>$assignment, "subfigure" =>$subFigArr[$i]);
           array_push($body,$array);
        }

        $params = [
            'index' => 'annotations',
            'body'  =>  ['data'=> $body]
        ];
       
        $response = $client->index($params);
        print_r($response);

     
       

        // for ($i=0;$i<count($arr);$i++){
        //    $array = array( "compoundfigure_file"=>$arr[$i] , "assignments" =>$assignment);
        //    array_push($body,$array);
        // }
        // $json = json_encode($body);

        
        // $url = 'http://localhost:9200/annotations/';


        // // use key 'http' even if you send the request to https://...
        // $options = array(
        //     'http' => array(
        //         'ignore_errors' => true,
        //         'header'  => "Content-type: application/json",
        //         'method'  => 'PUT',
        //         'content' => http_build_query($body)
        //     )
        // );
        // $context  = stream_context_create($options);
        // $result = file_get_contents($url, false, $context);
        // if ($result === FALSE) { print_r("error"); }

        // var_dump($result);
        // $query = $client->index([
        //     'index'=> 'annotations',
        //     'type' => 'ann',
        //     'body'=>[
        //         'compoundfigure_file' => 'test'
        //     ]    
        // ]);
    
        // print_r($query);
        
?>