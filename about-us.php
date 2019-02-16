<!-- HTML HEADER-->
<?php include 'static_block/html-header.php'; ?>

<!-- PDO -->          
<?php include 'static_block/bdd.php'; ?>


  <title>About Us - Residence Estates</title>

  <script src="js/jquery.min.js"></script>

  <script>

    $(document).ready(function () {
      
    });

  </script>

  <style type="text/css">
    html,body,#container{height:100%; overflow:visible;}

    #content{padding-bottom:20px;}

    @media only screen and (min-width: 1200px) {
      #menu dt.who{
        background: #EF7F00;
      }

      .who a, .who a:link{background-color:#EF7F00; color:#FFF;}
    }
    @media only screen and (min-width: 300px) and (max-width: 1200px) {

      #menu dt.who a{border-bottom:3px solid #EF7F00;}

    }
    
  </style>

</head>

<body>

<?php

  try
  {        

    //On récupère tout le contenu de la table news
    $info = $bdd->query('SELECT * FROM information');
    $About = $bdd->query('SELECT * FROM aboutus');
    $budys = $bdd->query('SELECT * FROM budys');

  }
  
  //Au cas ou ca ne fonctionne pas :
  
  catch (Exception $e)
  {
    die('Erreur : ' . $e->getMessage());
  }

?>

<div id="contener" class="about"><!-- START: Contener -->
		
  <div id="sidebar">

		<div id="logo">

		  <a href="index.php"><img src="images/logo.png" alt="logo"/></a>

		</div>

		<div id="menu">

			<?php include 'static_block/menu.php'; ?>

		</div>

    <div id="footer">
        <?php include 'static_block/footer.php'; ?>
    </div>
    
	</div>
        
  <div id="header"><!-- START: Header -->

  	<img src="images/about_header.jpg" border="0" alt="House"/>
  	<!-- <h1>About us</h1> -->

  </div><!-- END: Header -->
        
        
  <div id="content"><!-- START: Content -->

    <div id="contact-bar" class="empty"><!-- START: Orange Contact Bar -->
        <div id="content-bar"></div>
    </div>

    <div id="breadcrumbs">

      <ul>
      
        <li>
          <a href="/index.php" title="Back to home page">Home</a>
          <span> |</span>
        </li>
      
        <li>
          <span class="current">About Us</span>
        </li>
      
      </ul>
    
    </div>

    <div id="title_search" class="title">

      <h1>About Residence Estates</h1>

    </div>

    
    <div id="column_about" class="left-col column">

      <?php

      //On lance la boucle pour créer toutes les images.
        while ($donnees = $About->fetch())
        {

      ?>
            
            <p class="short_desc"><?php echo stripslashes(nl2br($donnees['Intro']));?></p>

            <p class="desc"><?php echo stripslashes(nl2br($donnees['About']));?></p>  
      <?php

        }
        //On arrete la lecture de la table.
        $About->closeCursor();

        
      ?>
            <ul class="reside1-budys">

            <?php
            //On lance la boucle pour créer toutes les images.
                while ($donnees = $budys->fetch())
                {

            ?>
            
              <li>
                <img src="images/budys/<?php echo $donnees['Picture'];?>" height="45" alt="budys logo"/>
              </li>
              
              <?php

                }
                //On arrete la lecture de la table.
                $budys->closeCursor();
              ?>

            </ul>                 
            
        </div>
      <?php
      

        //On lance la boucle pour créer toutes les images.
        while ($donnees = $info->fetch())
        {

      ?>

          <div class="left-col column">

            <ul>
            
              <li>
                <img src="images/Address.png" alt="icon house" />
                <p><?php echo $donnees['Address']; ?></p>
              </li>
            
              <li>
                <img src="images/Tel.png" alt="icon phone"/>
                <p><?php echo $donnees['Phone']; ?></p>
              </li> 
            
              <li>
                <img src="images/Email.png" alt="icon pen"/>
                <a href="contact-us.php" alt="contact us"><?php echo $donnees['Email']; ?></a>
              </li>   
            
            </ul>                    
              
          </div>
        
      <?php
      
        }
        //On arrete la lecture de la table.
        $info->closeCursor();
      
      ?>
      
        <div class="clearfix"></div>

        <!-- <div id="sofa" style="width:100%; margin-top:110px; background-color:#FFF;"><img src="images/sofa.jpg" alt="sofa" style="position:relative; left:650px; top:-146px;"/></div> -->
       
        

  </div><!-- END: Content -->
        
</div><!-- END: Contener -->

<!-- Menu -->

<script type="text/javascript">
  var arrow_properties = true;
  $('.arrow_link_properties').click(function(){
    if( arrow_properties == true){
      $('.arrow_right_properties').addClass("close");
      $('#Section1').css({height: '75px'});
      arrow_properties = false;
    }else{
      $('.arrow_right_properties').removeClass("close");
      $('#Section1').css({height: '0em'});
      arrow_properties = true;
    }
  });
  var arrow_commercials = true;
  $('.arrow_link_commercials').click(function(){
    if( arrow_commercials == true){
      $('.arrow_right_commercials').addClass("close");
      $('#Section2').css({height: '50px'});
      arrow_commercials = false;
    }else{
      $('.arrow_right_commercials').removeClass("close");
      $('#Section2').css({height: '0em'});
      arrow_commercials = true;
    }
  });
</script>
</body>
</html>
