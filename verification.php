<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
         
    <style type="text/css">
        *{
            padding:0;
            margin:0;
            box-sizing:border-box;
            font-family:sans-serif;
        }
        body{
            background-color: rgb(238, 238, 238);
        }
        .main{
            height:80vh;
            width:80%;
            margin: 5% auto;
        }
        section{
            width:100%;
            height:100%;
            display:flex;
        }
        .left{
            flex-basis:50%;
            background-color: rgb(0, 75, 140);
            cursor:pointer;
            position: relative;
            transition: 0.4s ease-in-out;
            background-blend-mode: darken;
            background-size: cover;
        }
        .right{
            flex-basis:50%;
            background:#fff;
            cursor:pointer;
            transition: 0.8s ease-in-out;
            position: relative;
            background-blend-mode: darken;
            background-size: cover;
        }
        h1{
            font-size: 2em;
            color: white;
            
            font-family: "Montserrat", sans-serif;
        }
        h4{
            font-size: 1.5em;
            color: white;
            
            font-family: "Montserrat", sans-serif;
        }
        .text{
            position: absolute;
            
            font-family: "Montserrat", sans-serif;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            text-align: center;
        }
        button{
            padding: 10px 20px;
            border: none;
            outline: none;
            border-radius: 8px ;
            color: rgb(0, 75, 140);
            
            transition: 0.2s ease-in-out;
        }
        .b1{
            background-color: #fff;
        }
        .b1:hover{
            border: 1px solid #fff;
            background-color:rgb(0, 75, 140) ;
            color: white;
        }
        .bold{
            font-size: 2em;
        }
        a{
            color: #fff;
        }
        a:hover{
            color: #bbb;
        }
        
    </style>
</head>
<body>
    <section class="main">
        <section>
            <div class="left">
                <div class="text">
                    <h1 class="bold" >Vérification par e-mail</h1>
                    <br>
                    <br>
                    <h4 >Veuillez vérifier votre courrier électronique pour valider votre compte.</h4>
                
                    <br>
                    <button class="b1">Accéder à votre boîte de réception.</button>
                    <br>
                    <br>

                    <a href="#">N'avez-vous pas encore reçu d'e-mail ? </a>
                </div>
                <div class="overlay"></div> 
            </div>
            <div class="right">
                <div class="text">
                    <img src="./img/check_your_email.png" alt="">
                </div> 
            </div>
            
        </section>
    </section>
</body>
</html>