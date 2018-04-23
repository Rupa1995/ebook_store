<?php 
  include 'session.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Books ebook_store</title>
  <link rel="icon" type="images/png" href="images/book.png">
  <meta charset="utf-8">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width,height=device-height">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Varela+Round&amp;subset=hebrew,latin-ext,vietnamese" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="stylesheets/style.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/animate.css">
    
    
</head>

<body>

 <header id="home">      
 <div class="container">
      <div class="header-top">
            <div class="upper-header container">
             <form class="search-form" action="#" method="get">
                <i class="fa fa-search"></i>
                <input type="text" name="s" value placeholder="Search by book title..">
                <input type="hidden" name="post_type" value="product">
             </form>
              <div class="logo">
                <h1>Books</h1><br>
                <span>ebook store</span>
              </div>  
              <div class="pull-right menu">
                <div class="right-nav">
                  <ul class="log">
                    <li><a href="#">Wishlist</a></li>
                    <li><a href="#">Cart</a></li>
                     <li>
                      <?php 
                      if(isset($_SESSION['login_user'])){
                        echo '<a href="logout.php" class="login_user">Logout</a>';
                        } 
                        else{ 
                          echo '<a href="register.php?action=logout" class="register_user">Login/SignUp</a>';
                          }
                       ?>
                    </li>
                </ul>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="lower-header container">
              <div class="main-navig">
                <ul class="main-nav col-md-12 col-sm-12 hidden-xs">
                  <li><a href="#">Books</a></li>
                  <li><a href="#">Best Sellers</a></li>
                  <li><a href="#">Browse Genres</a></li>
                  <li><a href="#">TextBooks</a></li>
                  <li><a href="#">Exam Central</a></li>
                  <li><a href="#">Childern's & Young Adult</a></li>
                </ul>
              </div>
            </div>
      </div>
    </div>
    <section class="bg-parallax-1">
        <div class="container video-container">
          <video id="myVideo" autoplay="true" loop>
              <source src="videos/v1.mp4" type="video/mp4" width="100%">
          </video>
            <div class="overlay-desc">
              <h1 id="h1">books world 3</h1>
            </div>
        </div>
    </section>  
 </header>

<section class="text-center section-padding" id="intro">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <h1 class="wow fadeInDown">Shop by genre</h1>
            <div class="genre-icons container">
              <ul class="genre-ul col-md-12 col-sm-12 hidden-xs wow zoomIn">
                <li class="genre-li"><a href="#"><img src="/images/Literature-and-Fiction.png"></a></li>
                <li class="genre-li"><a href="#"><img src="/images/ChildrenYoung-Adult.png"></a></li>
                <li class="genre-li"><a href="#"><img src="/images/CrimeThriller.png"></a></li>
                <li class="genre-li"><a href="#"><img src="/images/Romance.png"></a></li>
                <li class="genre-li"><a href="#"><img src="/images/ExamCentral.png"></a></li>
                <li class="genre-li"><a href="#"><img src="/images/Sci-fantasy.png"></a></li>
                <li class="genre-li"><a href="#"><img src="/images/Textbooks.png"></a></li>
                <li class="genre-li"><a href="#"><img src="/images/Editor_sCorner.png"></a></li>
            </ul>
      </div>
        </div>
      </div>
    </div>
</section>

<section class="text-center section-padding" id="features">
      <div class="intro2 container">
          <div class="row">
            <div class="col-md-12">
                <h1 class="wow fadeInDown">Books you may love</h1>
                <br><br><br>
                <div class="row">
                  <div class="col-md-3">
                      <div class="icon wow fadeIn" data-wow-duration="2s"><img src="/images/book1.jpeg" id="book-ad"></div>
                      <h6 class="wow fadeInDown" data-wow-delay:"2s"><b>LINCOLN IN THE BARDO //</b></h6><hr>
                      <p class="wow fadeInUp" data-wow-delay:"3s">Lincoln in the Bardo is a 2017 experimental novel by American writer George Saunders. It is Saunders's first full-length novel and was the New York Times hardcover fiction bestseller for the week of March 5, 2017.</p>
                  </div>
                  <div class="col-md-3">
                      <div class="icon wow fadeIn" data-wow-duration="3s"><img src="/images/book2.jpg" id="book-ad"></div>
                      <h6 class="wow fadeInDown" data-wow-delay:"2s"><b>SING, UNBURIED, SING  //</b></h6><hr>
                      <p class="wow fadeInUp" data-wow-delay:"3s">Sing, Unburied, Sing is a 2017 novel by Jesmyn Ward. It is about a family's dynamics in the fictional town of Bois Savauge, Mississippi, where her 2011 National Book Award-winning Salvage the Bones was set pre-Hurricane Katrina</p>
                  </div>
                  <div class="col-md-3">
                      <div class="icon wow fadeIn" data-wow-duration="4s"><img src="/images/book3.jpg" id="book-ad"></i></div>
                      <h6 class="wow fadeInDown" data-wow-delay:"2s"><b>THREE DAUGHTERS OF EVE //</b></h6><hr>
                      <p class="wow fadeInUp" data-wow-delay:"3s">Elif Shafak’s new novel, Three Daughters of Eve, in its efforts to speak to the broader ideological concerns that underlie the pernicious anti-Muslim hate-filled rhetoric, is a text to linger over.. Shafak focuses her tale on a Polaroid photograph.
                      </p>
                  </div> 
                  <div class="col-md-3">
                        <div class="icon wow fadeIn" data-wow-duration="4s"><img src="/images/book4.jpg" id="book-ad"></i></div>
                        <h6 class="wow fadeInDown" data-wow-delay:"2s"><b>WHITE TEARS //</b></h6><hr>
                        <p class="wow fadeInUp" data-wow-delay:"3s">Hari Kunzru's "transfixing" novel ,White Tears, is a ghost story, a terrifying murder mystery, a timely meditation on race, and a love letter to all the forgotten geniuses of American music and Delta Mississippi Blues.
                        </p>
                  </div> 
              </div>
                <div class="clearfix"></div>
            </div>
          </div>
        </div>
</section>

<section class="responsive-design">
  <div class="gray-half-bg">&nbsp;</div>
  <div class="container">
    <div class="row">
      
      <div class="col-sm-6 block">
        <div class="myCarousel wow zoomIn" data-wow-duration="3s">
           
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                  <div class="carousel slide" data-ride="carousel">
                      <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active">
                        </li>
                        <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                      <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                      </ol>
                    <div class="carousel-inner">
                      <div class="item active">
                        <div class="row">
                             <h1>RESPONSIVE DESIGN SPECIALIST</h1>
                              <br><br>
                          </div>
                        <p id="carsl">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ultricies nulla non metus pulvinar imperdiet. Praesent non adipiscing libero.</p>
                        <p id="carsl">Mauris ultrices odio vitae nulla ultrices iaculis. Nulla rhoncus odio eu lectus faucibus facilisis.Maecenas ornare augue vitae sollicitudin accumsan.</p>
                        <p id="carsl">Etiam eget libero et erat eleifend consectetur a nec lectus. Sed id tellus lorem. Suspendisse sed venenatis odio, quis lobortis eros..</p>
                        </div>
                      <div class="item">
                        <div class="row">
                            <h1>BOOTSTRAP SPECIALIST</h1>
                            <br><br>
                          </div>
                        <p id="carsl">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ultricies nulla non metus pulvinar imperdiet. Praesent non adipiscing libero.</p>
                        <p id="carsl">Mauris ultrices odio vitae nulla ultrices iaculis. Nulla rhoncus odio eu lectus faucibus facilisis.Maecenas ornare augue vitae sollicitudin accumsan.</p>
                        <p id="carsl">Etiam eget libero et erat eleifend consectetur a nec lectus. Sed id tellus lorem. Suspendisse sed venenatis odio, quis lobortis eros..</p>
                      </div>
                      <div class="item">
                      <div class="row">
                        <h1>BOOTSTRAP SPECIALIST 2</h1>
                        <br><br>
                      </div>
                      <p id="carsl">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ultricies nulla non metus pulvinar imperdiet. Praesent non adipiscing libero.</p>
                      <p id="carsl">Mauris ultrices odio vitae nulla ultrices iaculis. Nulla rhoncus odio eu lectus faucibus facilisis.Maecenas ornare augue vitae sollicitudin accumsan.</p>
                      <p id="carsl">Etiam eget libero et erat eleifend consectetur a nec lectus. Sed id tellus lorem. Suspendisse sed venenatis odio, quis lobortis eros..</p>
                      </div>
                    </div>
                  </div>
                </div>    
          </div>

      </div>
      <div class="col-sm-6 right-img block" ><img src="./images/b-desc.jpg" class="img-responsive wow slideInRight" data-wow-duration="3s"> </div>
    </div>
  </div>
</section>
<section class="portfolio text-center section-padding" id="portfolio">
    <div class="container">
        <div class="row">
          <div class="card card-raised card-carousel wow zoomIn" data-wow-duration="2s">
          <div id="carousel-generic" class="carousel slide" data-ride="carousel">
          <div class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carousel-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-generic" data-slide-to="1" class=""></li>
              </ol>
          <div class="carousel-inner">
            <div class="item active">
                  <div class="col-md-4">
                    <div class="imge">
                      <div class="overly">
                        
                          <a href="#home">
                            <img src="images/portfolio-01.jpg" alt="Lights" class="image">
                            <div class="overlay">
                              <div class="glyphicon glyphicon-search">
                                <p id="gly"><b>view more</b></p>
                              </div>
                            </div>
                          </a>
                        </div>
                        <h6 id="a2"><b>CREATIVE MINDS</b></h6>
                        <hr>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ultricies nulla non metus pulvinar imperdiet. Praesent non adipiscing libero.</p>
                    </div>
                </div>
                  <div class="col-md-4">
                    <div class="imge">
                       <div class="overly">
                        <a href="#home">
                        <img src="images/portfolio-02.jpg" alt="laptop" class="image">
                        <div class="overlay">
                              <div class="glyphicon glyphicon-search"><p id="gly"><b>view more</b></p>
                              </div>
                            </div>
                        </a>
                      </div>
                      <h6 id="a2"><b>CREATIVE HEARTS</b></h6>
                      <hr>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ultricies nulla non metus pulvinar imperdiet. Praesent non adipiscing libero.</p>
                    </div>
                </div>
                  <div class="col-md-4">
                    <div class="imge">
                      <div class="overly">
                       <a href="#home">
                       <img src="images/portfolio-03.jpg" alt="dog" class="image">
                         <div class="overlay">
                              <div class="glyphicon glyphicon-search">
                                <p id="gly"><b>view more</b></p>
                              </div>
                            </div>
                               </a>
                             </div>
                        <h6 id="a2"><b>CREATIVE IDEAS</b></h6>
                        <hr>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ultricies nulla non metus pulvinar imperdiet. Praesent non adipiscing libero.</p>
                        </div>
                </div>
              </div>
              <div class="item">
                    <div class="col-md-4">
                      <div class="imge">
                        <div class="overly">
                          <a href="#home">
                            <img src="images/portfolio-01.jpg" alt="Lights" class="image">
                            <div class="overlay">
                                <div class="glyphicon glyphicon-search">
                                  <p id="gly"><b>view more</b></p>
                                </div>
                              </div>
                            </a>
                          </div>
                          <h6 id="a2"><b>CREATIVE MINDS</b></h6>
                          <hr>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ultricies nulla non metus pulvinar imperdiet. Praesent non adipiscing libero.</p>
                      </div>
                  </div>
                    <div class="col-md-4">
                      <div class="imge">
                        <div class="overly">
                          <a href="#home">
                          <img src="images/portfolio-02.jpg" alt="laptop" class="image">
                          <div class="overlay">
                                <div class="glyphicon glyphicon-search">
                                  <p id="gly"><b>view more</b></p>
                                </div>
                              </div>
                          </a>
                        </div>
                        <h6 id="a2"><b>CREATIVE HEARTS</b></h6>
                        <hr>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ultricies nulla non metus pulvinar imperdiet. Praesent non adipiscing libero.</p>
                      </div>
                    </div>
                  
                    <div class="col-md-4">
                      <div class="imge">
                        <div class="overly">
                         <a href="#home">
                         <img src="images/portfolio-03.jpg" alt="dog" class="image">
                           <div class="overlay">
                                <div class="glyphicon glyphicon-search">
                                  <p id="gly"><b>view more</b></p>
                                </div>
                              </div>
                                 </a>
                             </div>
                          <h6 id="a2"><b>CREATIVE IDEAS</b></h6>
                          <hr>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ultricies nulla non metus pulvinar imperdiet. Praesent non adipiscing libero.</p>
                          </div>
                       </div>
                </div>
            </div>
          </div>
         </div>   
       </div>
     </div>
    </div>
</section> 

<div class="ignite text-center">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <a href="#home" class="ignite-btn wow infinite pulse" id="ign">Ignite Your Passion</a>
        </div>
      </div>
    </div>
</div>
  
<section class="feature text-center section-padding" id="team">
    <div id="intro2" class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="wow fadeInDown">WE'RE A TEAM THAT ADORE WHAT WE DO</h1>
          <br><br><br>
          <div class="row">
            <div class="col-md-4">
             
                    <img src="images/team-01.png" alt="john snow" class="wow zoomIn">
                
              <h6 id="a2" class="wow fadeInUp"><b>JON SNOW</b></h6><hr>
              <p class="wow fadeInUp">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ultricies nulla non metus pulvinar imperdiet. Praesent non adipiscing libero.</p>
               <div class="social">
                 <ul id="social-button" class="list-inline">
                  <li>
                    <a href="#home" class="social-btn wow rollIn">
                      <i class="fa fa-dribbble"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#home" class="social-btn wow rollIn">
                      <i class="fa fa-twitter"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#home" class="social-btn wow rollIn">
                      <i class="fa fa-envelope"></i>
                    </a>
                  </li>
                 </ul>
              </div>
             </div>
            <div class="col-md-4">
             
                  <img src="images/team-02.png" alt="cersei lannister" class="wow zoomIn">
                
              <h6 id="a2" class="wow fadeInUp"><b>CERSEI LANNISTER</b></h6><hr>
              <p class="wow fadeInUp">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ultricies nulla non metus pulvinar imperdiet. Praesent non adipiscing libero.</p>
              <div class="social">
                  <ul id="social-button" class="list-inline">
                    <li>
                      <a href="#home" class="social-btn wow rollIn">
                        <i class="fa fa-dribbble"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#home" class="social-btn wow rollIn">
                        <i class="fa fa-twitter"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#home" class="social-btn wow rollIn">
                        <i class="fa fa-envelope"></i>
                      </a>
                    </li>
                  </ul>
              </div>
            </div>
            <div class="col-md-4">
                
                    <img src="images/team-03.png" alt="jamie lannister" class="wow zoomIn">
                
              <h6 id="a2" class="wow fadeInUp"><b>JAMIE LANNISTER</b></h6><hr>
              <p class="wow fadeInUp">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ultricies nulla non metus pulvinar imperdiet. Praesent non adipiscing libero.</p>
              <div class="social">
                 <ul id="social-button" class="list-inline">
                  <li>
                    <a href="#home" class="social-btn wow rollIn">
                      <i class="fa fa-dribbble"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#home" class="social-btn wow rollIn">
                      <i class="fa fa-twitter"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#home" class="social-btn wow rollIn">
                      <i class="fa fa-envelope"></i>
                    </a>
                  </li>
                </ul>
            </div>
            </div> 
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
</section>
  
<section class="subscribe text-center wow slideInLeft" data-wow-duration="2s">
    <div class="container">
      <h1>
        <i class="fa fa-paper-plane wow lightSpeedIn" data-wow-delay="2s" ></i><br>
        <span>Subscribe to stay in the loop</span>
      </h1>
      <form action="#home">
        <input type="text" name="placeholder required">
        <input type="submit" value="Send">
      </form>
    </div>
</section>

<section class="contact text-center" id="contact">
    <a href="#" class="up-btn">
        <i class="fa fa-chevron-up"></i>
    </a>
        <div class="container">
            <div class="row">
              <div class="col-md-12 wow fadeInDown">
                <h1>DROP US A LINE</h1>
                  
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
              <div class="row contact-details">
                <div class="col-md-4 wow pulse">
                  <div class="light-box box-hover">
                    <h2><i class="fa fa-map-marker wow bounce" data-wow-delay="0.5s" data-wow-duration="1s" data-wow-offset="1" id="fa-i"></i><br><br>
                      <span>Address</span></h2><hr>
                      <p>Level 6, 23 Pitt St, Sydney</p>
                   </div>
                </div>
                <div class="col-md-4 wow pulse">
                  <div class="light-box box-hover">
                    <h2><i class="fa fa-mobile wow wobble" data-wow-delay="1s" data-wow-duration="1s" id="fa-i"></i><br><br>
                      <span>Phone</span></h2><hr>
                      <p>+61 9 211 3747</p>
                    </div>
                </div>
                <div class="col-md-4 wow pulse">
                  <div class="light-box box-hover">
                    <h2><i class="fa fa-paper-plane wow lightSpeedIn" data-wow-delay="1s" id="fa-i"></i><br><br>
                      <span>Email</span></h2><hr>
                      <p>hey@halcyondays.com</p>
                    </div>
                </div>
              </div>

                 <div class="social">
                          <ul id="social-button" class="list-inline">
                            <li>
                              <a href="#home" class="social-btn wow rollIn">
                                <i class="fa fa-dribbble"></i>
                              </a>
                            </li>
                            <li>
                              <a href="#home" class="social-btn wow rollIn">
                                <i class="fa fa-twitter"></i>
                              </a>
                            </li>
                            <li>
                              <a href="#home" class="social-btn wow rollIn">
                                <i class="fa fa-envelope"></i>
                              </a>
                            </li>
                          </ul>
                    </div>
                </div>
            </div>
        </div>
</section>

<footer>
    <div class="container">
    
      <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-6 legals">
             <p><a href="#home">Terms & Conditions</a> |
             <a href="#home">Legals</a>
             </p>     
          </div>
          <div class="col-md-6 col-sm-6 col-xs-6 credit">
              <p>Developed & Designed by <a href="#home"><em>Rupa Rani</em></a> exclusively for <a href="#home">
                <em>Innoraft</em></a></p>
          </div>
      </div>

    </div>
</footer>
<a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="javascripts/javas.js"></script>
<script src="javascripts/wow.min_.js"></script>
<script>
  wow = new WOW(
  {
    boxClass: 'wow',
    animateClass: 'animated',
    offset: 0,
    mobile: true,
    live: true
  })
  wow.init();
</script>
</body>
</html>