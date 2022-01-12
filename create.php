<?php

require 'db.php';

function Clean($input)
{
    return trim(strip_tags(stripslashes($input)));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = Clean($_POST['title']);
    $content = Clean($_POST['content']);
    $date = Clean($_POST['date']);
    $image=Clean($_POST['name']);

    $errors = [];

    
    if (empty($title)) {
        $errors['title'] = 'Field Required';
    }

    
    if (empty($content)) {
        $errors['content'] = 'Field Required';
    } elseif (strlen($content)<10) {
        $errors['content'] = 'length must be >=10 chars';
    }


    function isValidDate($date, $format= 'Y-m-d'){
        return $date == date($format, strtotime($date));
    }

    if(!empty($_FILES['image']['name'])){
        $imgName     = $_FILES['image']['name'];
        $imgTempPath = $_FILES['image']['tmp_name'];
        $imagSize    = $_FILES['image']['size'];
        $imgType     = $_FILES['image']['type'];
    
    
        $imgExtensionDetails = explode('.',$imgName);
        $imgExtension        = strtolower(end($imgExtensionDetails));
    
        $allowedExtensions   = ['png','jpg','gif'];
    
           
        if(in_array($imgExtension ,$allowedExtensions)){
                
              
            $finalName = rand().time().'.'.$imgExtension;
    
             $disPath = './upload/'.$finalName;
              
            if(move_uploaded_file($imgTempPath,$disPath)){
                echo 'Image Uploaded';
            }else{
                echo 'Error Try Again';
            }
    
           }else{
               echo 'Extension Not Allowed';
           }
    
    
       }else{
           echo 'Image Field Required';
       }

    }
    if (count($errors) > 0) {
        foreach ($errors as $key => $value) {
            # code...
            echo '* ' . $key . ' : ' . $value . '<br>';
        }
    } else {
        $password = md5($password);

        # store data ......
        $sql = "insert into blogs (title,content,date,image) values ('$title','$content','$date,$image')";

        $op = mysqli_query($con, $sql);

        if ($op) {
            $message = 'Raw Inserted';
        } else {
            $message = 'Error try Again : ' . mysqli_error($con);
        }

        $_SESSION['message'] = $message;
        header('Location: index.php');
    }


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta title="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Register</h2>


        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

            <div class="form-group">
                <label for="exampleInputtitle">title</label>
                <input type="text" class="form-control" id="exampleInputtitle" title="title" aria-describedby=""
                    placeholder="Enter title">
            </div>


            <div class="form-group">
                <label for="exampleInputcontent">content</label>
                <input type="text" class="form-control" id="exampleInputcontent1" title="content"
                    aria-describedby="contentHelp" placeholder="Enter content">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword">date</label>
                <input type="date" class="form-control" id="exampleInputPassword1" title="date"
                    placeholder="date">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword">image</label>
                <input type="file" name="image">
                
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>



</body>

</html>