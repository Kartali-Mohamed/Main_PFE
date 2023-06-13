<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choice</title>
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
        section{
            width:100%;
            height:90vh;
            display:flex;
        }
        .left{
            flex-basis:50%;
            background:rgba(0,0,0,0.8)url("./img/vid.jpg");
            cursor:pointer;
            position: relative;
            transition: 0.4s ease-in-out;
            background-blend-mode: darken;
            background-size: cover;
        }
        .right{
            flex-basis:50%;
            background:rgba(0,0,0,0.8)url("./img/art.jpg");
            cursor:pointer;
            transition: 0.8s ease-in-out;
            position: relative;
            background-blend-mode: darken;
            background-size: cover;
        }
        h1{
            font-size: 4em;
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
            background-color: white;
        }
        .b1:hover{
            border: 1px solid #fff;
            background-color:rgb(0, 75, 140) ;
            color: white;
        }
        
        .left:hover{
            flex-basis: 90%;
            background:rgba(0, 75, 140,0.4)url("./img/vid.jpg");
            background-size: cover;
        }
        
        .right:hover{
            flex-basis: 90%;
            background:rgba(0, 75, 140,0.4)url("./img/art.jpg");
            background-size: cover;
        }
        .nav{
            width:100%;
            height:10vh;
            background:rgb(0, 75, 140);
        }
        
        .menu{
                position: absolute;
                top: 1%;
                left: 95%;
                transform: translateX(-50%);
                color:#fff;
            }
        .logout{
            position:absolute;
            top: 22%;
            transform: translateX(-100%);
        }
        .caption{
            
            font-size: 0.5em;
            text-align: center;
            position: absolute;
            top: 2%;
            left: 50%;
            transform: translateX(-50%);

        }
        .logo{
            
            font-size: 1.7em;
            text-align: center;
            position: absolute;
            top: 3%;
            left: 2%;
            color: #fff;

        }
        a{
            text-decoration:none;
            color:white;
        }
        a:hover{
            color:rgb(237, 194, 194);
        }
        .separate{
            color: #DDDFD6;
            display:inline-block;
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <div class="nav">
        <div class="logo">Mahroussa tech</div>
        <div class="caption">
            <h1>Qu'aimeriez-vous explorer aujourd'hui ?</h1>
        </div>
            <div class="menu">
                        <p>
                            <a class="btn " data-toggle="collapse" href="#target" role="button" aria-expanded="true" aria-controls="target">
                            <svg xmlns="http://www.w3.org/2000/svg" width="45" height="64" fill="white" class="bi bi-list" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                            </svg>
                            </a>
                        </p>
                        <div class="logout">
                                <div class="collapse multi-collapse" id="target">
                                    <div class="btn btn-danger bg-danger">
                                        <a href="logout.php">Deconnecter</a>
                                    </div>
                                </div>
                        </div>
            </div>
    </div>
    <section>
        <div class="left">
            <div class="text">
                <h1 >Videos</h1>
                <a href="./choices/Filma/index.php"><button class="b1">Voir les videos</button></a>
            </div>
            <div class="overlay"></div> 
        </div>
        <div class="right">
            <div class="text">
                <h1 >Articles</h1>
                <a><button class="b1" >Voir les articles</button></a>
            </div> 
            <div class="overlay"></div>
        </div>
        
    </section>
</body>
</html>