<?php 
  if(file_exists('config/config.php'))
    { 
      include 'config/config.php';      
    } 
    else 
    {
      throw new Exception('Unable to include Files.');  
    }
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Ebook Store</title>
  <link rel="icon" type="images/png" href="images/book.png">
  <meta charset="utf-8">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width,height=device-height"> 
  <link href="https://fonts.googleapis.com/css?family=Varela+Round&amp;subset=hebrew,latin-ext,vietnamese" rel="stylesheet">
  
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/waitMe.css">
  <link rel="stylesheet" type="text/css" href="stylesheets/style.css">
  <link rel="stylesheet" type="text/css" href="stylesheets/animate.css"> 
  <link rel="stylesheet" type="text/css" href="stylesheets/main.css"> 

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
                <div class="right-nav"  style="margin-right:77%;">
                  <div class="dropdown">
                    <i class = "fa fa-user dropdown-toggle" style = "font-size : 40px;" data-toggle="dropdown"></i>
                        <ul class="dropdown-menu">
                         <?php 
                              if(isset($_SESSION['login_user']))
                              {
                                echo '<li><a href="./edit_profile.php?uid='.$_SESSION['userID'].'">Edit Profile</a></li>';
                                echo '<li><a href="./user/cart_item.php">Cart</a></li>';
                                echo '<li><a href="#">Order</a></li>';
                                echo '<li><a href="./user/wishlist_item.php">Wishlist</a></li>';
                                echo '<li><a href="./logout.php" class="login_user">Logout</i></a></li>';
                              } 
                              else
                              { 
                                echo '<li><a href="./register.php?action=logout" class="register_user">Login/SignUp</a></li>';
                               }
                             ?>
                      </ul>
                  </div> 
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="lower-header container">
              <div class="main-navig">
                <ul class="main-nav col-md-12 col-sm-12 hidden-xs">
                  <li><a href="user/book.php">Books</a></li>
                  <li><a href="#">Best Sellers</a></li>
                  <li><a href="#">Browse Genres</a></li>
                  <li><a href="#">TextBooks</a></li>
                  <li><a href="#">Blogs</a></li>
                  <li><a href="#">About Us</a></li>
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

<section class="text-center section-padding" id="features">
      <div class="intro2 container">
          <div class="row">
            <div class="col-md-12">
                <h1 class="wow fadeInDown">Books you may love</h1>
                <br><br><br>
                <div class="row">
                  <div class="col-md-3">
                      <div class="icon wow fadeIn" data-wow-duration="2s"><img src="images/book1.jpeg" id="book-ad"></div>
                      <h6 class="wow fadeInDown" data-wow-delay:"2s"><b>LINCOLN IN THE BARDO //</b></h6><hr>
                      <p class="wow fadeInUp" data-wow-delay:"3s">Lincoln in the Bardo is a 2017 experimental novel by American writer George Saunders. It is Saunders's first full-length novel and was the New York Times hardcover fiction bestseller for the week of March 5, 2017.</p>
                  </div>
                  <div class="col-md-3">
                      <div class="icon wow fadeIn" data-wow-duration="3s"><img src="images/book2.jpg" id="book-ad"></div>
                      <h6 class="wow fadeInDown" data-wow-delay:"2s"><b>SING, UNBURIED, SING  //</b></h6><hr>
                      <p class="wow fadeInUp" data-wow-delay:"3s">Sing, Unburied, Sing is a 2017 novel by Jesmyn Ward. It is about a family's dynamics in the fictional town of Bois Savauge, Mississippi, where her 2011 National Book Award-winning Salvage the Bones was set pre-Hurricane Katrina</p>
                  </div>
                  <div class="col-md-3">
                      <div class="icon wow fadeIn" data-wow-duration="4s"><img src="images/book3.jpg" id="book-ad"></i></div>
                      <h6 class="wow fadeInDown" data-wow-delay:"2s"><b>THREE DAUGHTERS OF EVE //</b></h6><hr>
                      <p class="wow fadeInUp" data-wow-delay:"3s">Elif Shafak’s new novel, Three Daughters of Eve, in its efforts to speak to the broader ideological concerns that underlie the pernicious anti-Muslim hate-filled rhetoric, is a text to linger over.. Shafak focuses her tale on a Polaroid photograph.
                      </p>
                  </div> 
                  <div class="col-md-3">
                        <div class="icon wow fadeIn" data-wow-duration="4s"><img src="images/book4.jpg" id="book-ad"></i></div>
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


<section class="portfolio text-center section-padding" id="portfolio">
    <div class="container">
        <div class="row">
          <div class="card card-raised card-carousel">
          <div id="carousel-generic" class="carousel slide" data-ride="carousel">
          <div class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carousel-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-generic" data-slide-to="1" class=""></li>
              </ol>
          <div class="carousel-inner">
            <div class="item active">
              <div class="col-md-3">
                      <div class="imge">
                        <div class="overly">
                         <a href="#home">
                         <img src="images/book_img/Half_Girlfriend.jpg" alt="book10" class="image">
                           <div class="overlay">
                                <div class="glyphicon glyphicon-search">
                                  <p id="gly"><b>view more</b></p>
                                </div>
                              </div>
                                 </a>
                             </div>
                          <h6 id="a2"><b>book 6</b></h6>
                          <hr>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ultricies nulla non metus pulvinar imperdiet. Praesent non adipiscing libero.</p>
                          </div>
                       </div>
                  <div class="col-md-3">
                    <div class="imge">
                      <div class="overly">
                        
                          <a href="#home">
                            <img src="images/book12.jpeg" alt="book12" class="image">
                            <div class="overlay">
                              <div class="glyphicon glyphicon-search">
                                <p id="gly"><b>view more</b></p>
                              </div>
                            </div>
                          </a>
                        </div>
                        <h6 id="a2"><b>book 1</b></h6>
                        <hr>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ultricies nulla non metus pulvinar imperdiet. Praesent non adipiscing libero.</p>
                    </div>
                </div>
                  <div class="col-md-3">
                    <div class="imge">
                       <div class="overly">
                        <a href="#home">
                        <img src="images/book11.jpeg" alt="book11" class="image">
                        <div class="overlay">
                              <div class="glyphicon glyphicon-search"><p id="gly"><b>view more</b></p>
                              </div>
                            </div>
                        </a>
                      </div>
                      <h6 id="a2"><b>book 2</b></h6>
                      <hr>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ultricies nulla non metus pulvinar imperdiet. Praesent non adipiscing libero.</p>
                    </div>
                </div>
                  <div class="col-md-3">
                    <div class="imge">
                      <div class="overly">
                       <a href="#home">
                       <img src="images/book5.jpg" alt="book5" class="image">
                         <div class="overlay">
                              <div class="glyphicon glyphicon-search">
                                <p id="gly"><b>view more</b></p>
                              </div>
                            </div>
                               </a>
                             </div>
                        <h6 id="a2"><b>book 3</b></h6>
                        <hr>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ultricies nulla non metus pulvinar imperdiet. Praesent non adipiscing libero.</p>
                        </div>
                </div>
              </div>
              <div class="item">
                    <div class="col-md-3">
                      <div class="imge">
                        <div class="overly">
                          <a href="#home">
                            <img src="images/book6.jpg" alt="book6" class="image">
                            <div class="overlay">
                                <div class="glyphicon glyphicon-search">
                                  <p id="gly"><b>view more</b></p>
                                </div>
                              </div>
                            </a>
                          </div>
                          <h6 id="a2"><b>book 4</b></h6>
                          <hr>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ultricies nulla non metus pulvinar imperdiet. Praesent non adipiscing libero.</p>
                      </div>
                  </div>
                    <div class="col-md-3">
                      <div class="imge">
                        <div class="overly">
                          <a href="#home">
                          <img src="images/book13.jpeg" alt="book13" class="image">
                          <div class="overlay">
                                <div class="glyphicon glyphicon-search">
                                  <p id="gly"><b>view more</b></p>
                                </div>
                              </div>
                          </a>
                        </div>
                        <h6 id="a2"><b>book 5</b></h6>
                        <hr>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ultricies nulla non metus pulvinar imperdiet. Praesent non adipiscing libero.</p>
                      </div>
                    </div>
                  
                    <div class="col-md-3">
                      <div class="imge">
                        <div class="overly">
                         <a href="#home">
                         <img src="images/book8.jpeg" alt="book8" class="image">
                           <div class="overlay">
                                <div class="glyphicon glyphicon-search">
                                  <p id="gly"><b>view more</b></p>
                                </div>
                              </div>
                                 </a>
                             </div>
                          <h6 id="a2"><b>book 6</b></h6>
                          <hr>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ultricies nulla non metus pulvinar imperdiet. Praesent non adipiscing libero.</p>
                          </div>
                       </div>
                       <div class="col-md-3">
                    <div class="imge">
                       <div class="overly">
                        <a href="#home">
                        <img src="images/book9.jpeg" alt="book9" class="image">
                        <div class="overlay">
                              <div class="glyphicon glyphicon-search"><p id="gly"><b>view more</b></p>
                              </div>
                            </div>
                        </a>
                      </div>
                      <h6 id="a2"><b>book 2</b></h6>
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

<!-- <div class="ignite text-center">
  <img src="images/book-ad.jpg">
</div> -->
  
<section class="feature text-center section-padding" id="team">
    <div id="intro2" class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="wow fadeInDown">Authors you may love</h1>
          <br><br><br>
          <div class="row">
            <div class="col-md-4">
             
                    <img src="images/team-01.png" alt="john snow" class="wow zoomIn">
                
              <h6 id="a2" class="wow fadeInUp"><b>George Saunders</b></h6><hr>
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
                
              <h6 id="a2" class="wow fadeInUp"><b>Elif Shafak</b></h6><hr>
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
                
              <h6 id="a2" class="wow fadeInUp"><b>Hari Kunzru</b></h6><hr>
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

<div class="modal fade" id="change_pass_pop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header">
          <button type="button" class="close" id="close_pass" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabelc">Change Password</h4>
        </div>
        <div class="modal-body">
          <div class="content-main">  
          <div class="form-group">
            <div class="row">
              <div class="col-sm-12">
                <div class="col-sm-6 col-md-6 col-lg-6">
                  <label>New Password <span class="red">*</span></label>
                  <input type="password" name="password" class="form-control" placeholder="New Password" id="pwd">
                  <p style="color:red" class="pwdErr error-display" id="pwdErr"></p>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                  <label>Confirm Password <span class="red">*</span></label>
                  <input type="password" name="password" class="form-control" placeholder="Confirm Password" id="cnfpwd">
                 <p style="color:red" class="cnfpwdErr error-display" id="cnfpwdErr"></p>
                </div>
              </div>
            </div>
          </div>
        <div class="modal-footer">
          <div class="pull-right">
            <button class="btn btn-sm green-btn" id="change_pass"  type="button" data-toggle="tooltip" data-original-title="">Save</button>
            <button class="btn btn-grey btn-sm page-scroll-set"  data-dismiss="modal" aria-label="Close" type="button" data-toggle="tooltip" id="cancelPass" data-original-title="">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </div>
    <!-- alert modal starts here -->
<div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabela" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="alertTitle">Message</h4>
        </div>  
        <div class="modal-body">
          <p id="alertBody"></p>
        </div>
        <input type="hidden" name="alert_value" id="alert_value">
        <div class="modal-footer text-center">
          <button type="button" id="changed_ok" data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-navyblue" data-placement="top" data-toggle="tooltip" data-original-title ="">OK</button>
        </div>
      </div>
    </div>
  </div>

<a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

<script type='text/javascript' src="js/jquery-3.3.1.min.js"></script>
<script type='text/javascript' src="js/bootstrap.min.js"></script>
<script type='text/javascript' src="js/waitMe.js"></script>
<script type='text/javascript' src="javascripts/javas.js"></script>
<script type='text/javascript' src="javascripts/wow.min_.js"></script>
<script type="text/javascript">
  wow = new WOW(
  {
    boxClass: 'wow',
    animateClass: 'animated',
    offset: 0,
    mobile: true,
    live: true
  })
  wow.init();

  var first_tym_flag = <?php echo $_SESSION['first_tym_flag']; ?>;
  var login_uid = <?php echo $_SESSION['userID']; ?>;
</script>
<script type='text/javascript' src="javascripts/comman.js"></script>
<script type='text/javascript' src="javascripts/index_out.js"></script>
</body>
</html>
