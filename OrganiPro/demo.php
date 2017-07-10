<?php
    $file = 'modeleXML.xml';
    $xml = simplexml_load_file($file);

    //generation de raccourci XML
   $racine = $xml->racine;
   $record = $xml->record;
    
   
   //regroupement des differents groupes
   $aGroupe = array();
   array_push($aGroupe, (string)$record[0]->groupe);

   for($i=1; $i < $record->count();$i++){
       if(!in_array($record[$i]->groupe, $aGroupe)){
           array_push($aGroupe, (string)$record[$i]->groupe);
       }
   }
  
   // generation des  elements
    $sElements = '';
    
    for ($i = 0; $i < (count($record)-1); $i++) {
        $oDoc = $xml->record[$i];
        $sElements .= "{id: 'ele_" .$oDoc['id']. "', label: '" . str_replace("'", " ",substr($oDoc->nom." ".$oDoc->prenom, 0, 20)) . "', group: 'icons'},\n";
    }

    // generation des  groupes
   $sGroup = '';
    
    for ($i = 0; $i < count($aGroupe); $i++) {
        $sGroup .= "{id: 'grp_" .substr($aGroupe[$i], 0, 20). "', label: '" . substr($aGroupe[$i], 0, 20) . "', group: 'mints'},\n";
    }
    
    $sGroup = rtrim(trim($sGroup), ',');
    
    // generation des liens
    $sLinks = '';
    
    for ($i = 0; $i < count($aGroupe); $i++) {
         $sLinks .= "{from: '".$racine."', to: 'grp_".substr($aGroupe[$i], 0, 20)."'},\n"; 
    }
            for ($j = 0; $j< (count($record))-1; $j++) {  
        $sLinks .= "{from: 'ele_".$record[$j]['id']. "', to: 'grp_".substr($record[$j]->groupe, 0, 20)."'},\n";
    }
    
    $sLinks = rtrim(trim($sLinks), ',');
    
    // generation des Urls
    $sCommentaires = '';
    for ($i = 0; $i < $xml->record->count(); $i++) {
        $oDoc = $xml->record[$i];
        $sCommentaires .= '"ele_'.$oDoc['id'].'":"'.$oDoc->projet.'",';
    }
    $sCommentaires = rtrim(trim($sCommentaires), ',');
    

?><!doctype html>
<html>
    <head>
        <title>Network | Basic usage</title>

        <script type="text/javascript" src="../OrganiPro/js/vis.js"></script>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="../css/vis-network.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

        <style type="text/css">
            #mynetwork {
                width: auto;
                height: 800px;
                border: 1px solid lightgray;
            }
        </style>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div class="center">
            <a href="index.php"><img src="logo/Network-Link.jpg" class="img-responsive" alt="Search"></a>
        </div>
        <h3 style="color: blue; text-align: center">Vue de l'activité commerciale de <?php echo $racine; ?></h3>
        <hr>
        <div id="eventSpan" style="background:#f0f0f5"></div>
        <hr>
        <div id="mynetwork"></div>

        <script type="text/javascript">
            
            // create an array with nodes
            var nodes = new vis.DataSet([
                {id: '<?php echo $racine ?>', label: '<?php echo $racine; ?>', group: 'racine'},
                <?php echo $sElements; ?>
                <?php echo $sGroup; ?>
            ]);

            var edges = new vis.DataSet([
                <?php echo $sLinks; ?>
            ]);

            var oCommentaire = {<?php echo $sCommentaires; ?>};
            var container = document.getElementById('mynetwork');
            var data = {
                nodes: nodes,
                edges: edges
            };
            var options = {
        nodes: {
            size: 20,
            font: {
                size: 15,
                color: '#3399ff'
            },
            borderWidth: 3
        },
        edges: {
            width: 2
        },
        groups: {
            mints: {color:'rgb(0,255,140)'},
            work: {
                shape: 'icon',
                icon: {
                    face: 'FontAwesome',
                    code: '\uf041',
                    size: 50,
                    color: '#00e600'
                }
            },
            icons: {
                shape: 'icon',
                icon: {
                    face: 'FontAwesome',
                    code: '\uf007',
                    size: 50,
                    color: 'orange'
                }
            },
            racine: {
                shape: 'icon',
                icon: {
                  face: 'FontAwesome',
                  code: '\uf1ad',
                  size: 75,
                  color: '#3399ff'
                }
            }
        }
    };
            var network = new vis.Network(container, data, options);
            
            network.on("click", function (params) {
                 // determine si c'est un document
                if( oCommentaire[ params.nodes[0] ] === undefined ){

return;
                }
                params.event = "[original event]";
                document.getElementById('eventSpan').innerHTML = '<u><h2>Note / Commentaires:</h2></u> <p class="center">' + oCommentaire [params.nodes[0] ] +'</p>';
                console.log( 'Identifiant : ' + params.nodes[0] );
                //console.log( JSON.stringify(params, null, 4) );
                console.log( oCommentaire[ params.nodes[0] ] );
                });
            
    
    
        </script>
    </body>
</html>