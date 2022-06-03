<?php 

$facts = false;
$file_facts = false;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(strcmp($_POST['action'],'new') == 0 && !empty($_POST['facts'])){
        $api_content = file_get_contents("http://dog-api.kinduff.com/api/facts?number=".$_POST['facts']);
        $facts = json_decode($api_content, true);
        
        $filename = 'results.json';
        $handle = @fopen($filename, 'r+');
        if ($handle === null) $handle = fopen($filename, 'w+');
        if ($handle){
            fseek($handle, 0, SEEK_END);

            if (ftell($handle) > 0){
                fseek($handle, -1, SEEK_END);
                fwrite($handle, ',', 1);
                fwrite($handle, json_encode($facts). ']');
            } else {
                fwrite($handle, json_encode(array($facts)));
            }
            fclose($handle);
        }
    }elseif(strcmp($_POST['action'],'previous') == 0 ){
        $file_content = file_get_contents('results.json');
        $file_facts = json_decode($file_content, true);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>XML projekt</title>
</head>
<body>
        <div class="row">
            <div class="col-12">
            <header>
                <div class="header-img">
                    <img src="images/cool-dog.png" alt="#">
                </div>
                <h1>Cool dog facts, yo! &#128526;</h1>
            </header>
            </div>
        </div>
    
        <div class="row all-facts">
            <div class="col-6 new-facts">
                <form action="index.php" method="post">
                    <label for="facts">How many <em>cooOOol</em> facts about dogs do you want?</label>
                    <input type="number" step="1" name="facts" placeholder="Enter number" required max="5" min="1">
                    <input type="hidden" name="action" value="new">
                    <input type="submit" value="Submit" class="new-submit">
                </form>
            </div>
            
            <div class="col-6 previous-facts">
                <form action="index.php" method="post">
                    <label for="facts">Do you wish to see previous facts?</label>
                    <input type="hidden" name="action" value="previous">
                    <input type="submit" value="Yes" class="previous-submit">
                </form>
            </div>
        </div>

    <div class="row result-facts">
        <div class="col-12">
            <?php if($file_facts){ ?>
                <div class="previous-facts">
                    <ul>
                        <?php foreach($file_facts as $fact_arr) foreach($fact_arr['facts'] as $f_fact) echo '<li>'.$f_fact.'</li>';  ?>
                    </ul>
                </div>
            <?php } ?>
            <?php if($facts){ ?>
                <div class="facts">
                    <ul>
                        <?php foreach($facts['facts'] as $fact) echo '<li>'.$fact.'</li>'; ?>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </div>
    
    <div class="row footer">
        <div class="col-12">
            <footer>
                <p>Kristina Čavčić (Informatički dizajn) - Tehničko Veleučilište u Zagrebu, 2022.</p>
                <p>XML Projekt - Dog API + JSON</p>
            </footer>
        </div>
    </div>
    



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>