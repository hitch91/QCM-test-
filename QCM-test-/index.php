<?php require 'class/classes.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>QCM de Test Lab-Event</title>
</head>
<body>
<header class="bg-light p-5 mb-4" style="text-align:center">
    <h1>Qcm test d'entreprise</h1>
</header>
    <main class="container bg-light p-5 rounded">
     <?php $qcm->generer();?>
     <form action="" method="post"></form>
    </main>
    <pre>
    
    <?php 
    $json = $qcm->getJson(); ?>
    </pre>
    <script src="bootstrap/js/jquery-3.5.1.min.js"></script>
    <script>

    let json = {};
    json = JSON.stringify(<?php echo $json; ?>);
    json = JSON.parse(json);


    $('.valid').click((e)=>{
        e.preventDefault();
        question = e.currentTarget.name;
        
        let numeroQuestion = question.substr(-1);
        let reponses = json.listeQuestion[numeroQuestion].reponse[0];
        let color = 'blanc';
        let reponse = $('.radio'+numeroQuestion);
        for(let i = 0; i<= reponse.length-1;i++){
            if(reponse[i].children[0].checked == true){
               var choixRep = reponse[i].innerText;
            };
        }
        for (const rep in reponses) {
            if(`${reponses[rep]}`== 1){
                if(`${rep}` == choixRep){
                    var bonneRep = true;
                    console.log("bonne reponse");
                }else{
                    bonneRep = false;
                    console.log("mauvaise reponse");
                }
            }
        }
        console.log(bonneRep);
        if(bonneRep === true){
            $('.cadre'+numeroQuestion).addClass('bg-success');
            $('.buttonValid'+numeroQuestion).css('display','none');
        }else{
            $('.cadre'+numeroQuestion).addClass('bg-danger');
            $('.buttonValid'+numeroQuestion).css('display','none');
        }


    })

    
    
    </script>
   
</body>
</html>