<!DOCTYPE html>
<html>
<head>
<style>
table {
  width: 100%;
  border-collapse: collapse;
}

table, td, th {
  border: 1px solid black;
  padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php 
    require_once 'init.php';
    require 'vendor/autoload.php';
    error_reporting(E_ERROR | E_PARSE);
    use Elastic\Elasticsearch\ClientBuilder;

    $client = ClientBuilder::create()
    ->setHosts(['localhost:9200'])
    ->build();

    $response = $client ->info();

   
        $q = $_GET['q'];
        $query1 = $client->search([
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

        if($query1['hits']['total']>=1){
            $results = $query1['hits']['hits'];
            $total = $query1['hits']['total']['value'];
        }

        // echo "total is ".$total;
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
        $url = "https://";   
        else  
        $url = "http://";   
        $url.= $_SERVER['HTTP_HOST'];   
        $url.= $_SERVER['REQUEST_URI'];    
        $url_components = parse_url($url);

        parse_str($url_components['query'], $params);

        $results_per_page = 10;
        $number_of_pages = ceil($total/$results_per_page);
        
        // determine which page number visitor is currently on
        // if ($params['page']== '') {
        //     echo "inside if page";
        // $page = 1;
        // } else {
        
            $page = $params['page'];
            // echo "page is =".$page;
        // }

        $this_page_first_result = ($page-1)*$results_per_page;
        
        $q = $_GET['q'];
        $query = $client->search([
            'body' => [
                'from' => $this_page_first_result,
                'size' => 10,
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
            $results2 = $query['hits']['hits'];
        }
        

        if (isset($results2)){
            echo "<h2> Records Found is ".$total."</h2>";
            echo "<table>
            <tr>
            <th>Compound Figure File</th>
            
            <th>Compound Figure </th>
            <th>Object</th>
            <th>Group ID</th>
            </tr>";       
            foreach ($results2 as $r){
                $path = "compound_test2007/".$r['_source']['figure_file'];
                echo "<tr>";
                echo "<td> <a href='subFigures.php?fig=". $r['_source']['figure_file']."' target='_blank' >" .  $r['_source']['figure_file'] . "</td>";
                // echo "<td style='width:20px;'>" . $r['_source']['figure_file'] . "</td>"; <-- <th>Caption</th> -->
                // echo "<td style='width:30px;'>" . $r['_source']['caption'] . "</td>";
                echo "<td><img style='width:20%;height:40%;' src= ".$path ." > </td>";
                echo "<td>" . $r['_source']['object'] . "</td>";
                echo "<td>" . $r['_source']['groupID'] . "</td>";
                
            }
            echo "</tr>";
        }
        echo "</table>";
        echo "<div>";
        for ($pag=1;$pag<=$number_of_pages;$pag++) {
            if($pag == $page){
                
            echo '<a style="color:red;" class="second" href="index.php?function=searchCaption&q='.$q.'&page=' . $pag . '" >' . $pag . '</a> ';
            echo"&nbsp";
            }
            else {
                echo '<a  class="second" href="index.php?function=searchCaption&q='.$q.'&page=' . $pag . '">' . $pag . '</a> ';
                echo"&nbsp";
            }
          }
        echo "</div>";
    ?>
</body>
</html>
    