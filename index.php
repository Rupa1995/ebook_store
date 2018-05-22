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
        <div class="logo">
          <h1>Books</h1><br>
          <span>eBook sTore</span>
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
                          echo '<li><a href="./user/order.php">Order</a></li>';
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
            <li><a href="user/book.php?book=1">Books</a></li>
            <li><a href="user/book.php?book=2">Best Sellers</a></li>
            <li><a href="user/browser_genre.php">Browse Genres</a></li>
            <li><a href="user/blogs.php">Blogs</a></li>
            <li><a href="user/about_us.php">About Us</a></li>
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
        <h1 id="h1">eBook sTore</h1>
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
              <div class="icon wow fadeIn" data-wow-duration="2s"><img src="images/book16.jpg" id="book-ad"></div>
              <h6 class="wow fadeInDown" data-wow-delay:"2s"><b>THE OUTSIDER //</b></h6><hr>
              <p class="wow fadeInUp" data-wow-delay:"3s">An oustanding work by Stephen King!<br> An unspeakable crime. A confounding investigation. At a time when the King brand has never been stronger, he has delivered one of his most unsettling and compulsively readable stories.</p>
          </div>
          <div class="col-md-3">
              <div class="icon wow fadeIn" data-wow-duration="3s"><img src="images/book2.jpg" id="book-ad"></div>
              <h6 class="wow fadeInDown" data-wow-delay:"2s"><b>SING, UNBURIED, SING  //</b></h6><hr>
              <p class="wow fadeInUp" data-wow-delay:"3s">Sing, Unburied, Sing is a 2017 novel by Jesmyn Ward. It is about a family's dynamics in the fictional town of Bois Savauge, Mississippi, where her 2011 National Book Award-winning Salvage the Bones was set pre-Hurricane Katrina</p>
          </div>
          <div class="col-md-3">
              <div class="icon wow fadeIn" data-wow-duration="4s"><img src="images/book15.jpg" id="book-ad"></i></div>
              <h6 class="wow fadeInDown" data-wow-delay:"2s"><b>The 17th Suspect //<br>(Women's Murder Club)</b></h6><hr>
              <p class="wow fadeInUp" data-wow-delay:"3s">In the newest Women's Murder Club thriller by James Patterson, a killer who chooses victims personally is stalking San Francisco--and getting too close to Detective Lindsay Boxer.
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
                         <a href="#">
                         <img src="images/book_img/Half_Girlfriend.jpg" alt="book10" class="image">
                           <!-- <div class="overlay">
                                <div class="glyphicon glyphicon-search">
                                  <p id="gly"><b>view more</b></p>
                                </div>
                              </div> -->
                                 </a>
                             </div>
                          <h6 id="a2"><b>Half Girlfriend</b></h6>
                          <hr>
                          <p>Half Girlfriend is an Indian English coming of age, young adult romance novel by Indian author Chetan Bhagat. The novel, set in rural Bihar, New Delhi, Patna, and New York, is the story of a Bihari boy in quest of winning over the girl he loves.</p>
                          </div>
                       </div>
                  <div class="col-md-3">
                    <div class="imge">
                      <div class="overly">
                        
                          <a href="#">
                            <img src="images/book12.jpeg" alt="book12" class="image">
                            <!-- <div class="overlay">
                              <div class="glyphicon glyphicon-search">
                                <p id="gly"><b>view more</b></p>
                              </div>
                            </div> -->
                          </a>
                        </div>
                        <h6 id="a2"><b>World's Best Boyfriend</b></h6>
                        <hr>
                        <p>Hate, is a four letter word. So is love. And sometimes, people can’t tell the difference...If you want to know the answer to it all, read the book.The book is a complete package defining love, friendship, betrayal and hatred that exists between the main characters of the story, Dhurv and Aranya.</p>
                    </div>
                </div>
                  <div class="col-md-3">
                    <div class="imge">
                       <div class="overly">
                        <a href="#">
                        <img src="images/book11.jpeg" alt="book11" class="image">
                        <!-- <div class="overlay">
                              <div class="glyphicon glyphicon-search"><p id="gly"><b>view more</b></p>
                              </div>
                            </div> -->
                        </a>
                      </div>
                      <h6 id="a2"><b>One Indian Girl</b></h6>
                      <hr>
                      <p>Bestselling author Chetan Bhagat, writing for the first time in a female voice, brings to you One Indian Girl, the heart-warming story of a modern Indian girl - Radhika Mehta who is getting married this week.However, let me warn you. You may not like her too much.</p>
                    </div>
                </div>
                  <div class="col-md-3">
                    <div class="imge">
                      <div class="overly">
                       <a href="#">
                       <img src="images/book5.jpg" alt="book5" class="image">
                         <!-- <div class="overlay">
                              <div class="glyphicon glyphicon-search">
                                <p id="gly"><b>view more</b></p>
                              </div>
                            </div> -->
                               </a>
                             </div>
                        <h6 id="a2"><b>Bad Wolf</b></h6>
                        <hr>
                        <p>Serafina Raider, daughter of rock star Kent Raider, has enough problems being pursued by the paparazzi. She thought her world was complicated enough until Devan Nolan made her into a shinigami - a hunter of evil ghosts. If you want to know her journey read the book.</p>
                        </div>
                </div>
              </div>
              <div class="item">
                    <div class="col-md-3">
                      <div class="imge">
                        <div class="overly">
                          <a href="#">
                            <img src="images/book6.jpg" alt="book6" class="image">
                           <!--  <div class="overlay">
                                <div class="glyphicon glyphicon-search">
                                  <p id="gly"><b>view more</b></p>
                                </div>
                              </div> -->
                            </a>
                          </div>
                          <h6 id="a2"><b>Lies That Bind Us</b></h6>
                          <hr>
                          <p>From a prize-winning and New York Times bestselling author comes a chilling novel of deception under the sun... Jan needs this. She's flying to Crete to reunite with friends she met there five years ago and relive an idyllic vacation.Wanna know what is going to happen there, grab this book.</p>
                      </div>
                  </div>
                    <div class="col-md-3">
                      <div class="imge">
                        <div class="overly">
                          <a href="#">
                          <img src="images/book13.jpeg" alt="book13" class="image">
                          <!-- <div class="overlay">
                                <div class="glyphicon glyphicon-search">
                                  <p id="gly"><b>view more</b></p>
                                </div>
                              </div> -->
                          </a>
                        </div>
                        <h6 id="a2"><b>The Lords of Rings</b></h6>
                        <hr>
                        <p>The Lord of the Rings is an epic high fantasy novel written by English author and scholar J. R. R. Tolkien. Presents the epic depicting the Great War of the Ring, a struggle between good and evil in Middle-earth, following the odyssey of Frodo the hobbit and his companions on a quest to destroy the Ring of Power.</p>
                      </div>
                    </div>
                  
                    <div class="col-md-3">
                      <div class="imge">
                        <div class="overly">
                         <a href="#">
                         <img src="images/book8.jpeg" alt="book8" class="image">
                           <!-- <div class="overlay">
                                <div class="glyphicon glyphicon-search">
                                  <p id="gly"><b>view more</b></p>
                                </div>
                              </div> -->
                                 </a>
                             </div>
                          <h6 id="a2"><b>The Da Vinci Code</b></h6>
                          <hr>
                          <p>The Da Vinci Code is a 2003 mystery thriller novel by Dan Brown. It follows "symbologist" Robert Langdon and cryptologist Sophie Neveu after a murder in the Louvre Museum in Paris causes them to become involved in a battle between the Priory of Sion and Opus Dei.</p>
                          </div>
                       </div>
                       <div class="col-md-3">
                    <div class="imge">
                       <div class="overly">
                        <a href="#">
                        <img src="images/book9.jpeg" alt="book9" class="image">
                        <!-- <div class="overlay">
                              <div class="glyphicon glyphicon-search"><p id="gly"><b>view more</b></p>
                              </div> -->
                            </div>
                        </a>
                      </div>
                      <h6 id="a2"><b>The Girl In The Ice</b></h6>
                      <hr>
                      <p>Her eyes are wide open. Her lips parted as if to speak. Her dead body frozen in the ice . . . She is not the only one.When a young boy discovers the body of a woman beneath a thick sheet of ice in a South London park, Detective Erika Foster is called in to lead the murder investigation. This crime thriller is a must read.</p>
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
                
              <h6 id="a2" class="wow fadeInUp"><b>Stephen King</b></h6><hr>
              <p class="wow fadeInUp">Stephen King is the author of more than fifty books, all of them worldwide bestsellers. His recent work includes The Bill Hodges Trilogy, Revival, and Doctor Sleep. His novel 11/22/63 was named a top ten book of 2011 by The New York Times Book Review and won the Los Angeles Times Book Prize for Mystery/Thriller as well as the Best Hardcover Book Award from the International Thriller Writers Association..</p>
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
                
              <h6 id="a2" class="wow fadeInUp"><b>J. K. Rowling</b></h6><hr>
              <p class="wow fadeInUp">Joanne Rowling, writing under the pen names J. K. Rowling and Robert Galbraith, is a British novelist, philanthropist, film producer, television producer and screenwriter who is best known for writing the Harry Potter fantasy series. <br>The books have won multiple awards, and sold more than 400 million copies, becoming the best-selling book series in history..</p>
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
                
              <h6 id="a2" class="wow fadeInUp"><b>James Patterson</b></h6><hr>
              <p class="wow fadeInUp">James Patterson is the world’s bestselling author, best known for his many enduring fictional characters and series, including Alex Cross, the Women’s Murder Club, Michael Bennett. Patterson’s writing career is characterized by a single mission: to prove to everyone, from children to adults, that there is no such thing as a person who “doesn’t like to read,” only people who haven’t found the right book. </p>
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
                      <p>EM/4 , Sector 2, Saltlake, Kolkata</p>
                   </div>
                </div>
                <div class="col-md-4 wow pulse">
                  <div class="light-box box-hover">
                    <h2><i class="fa fa-mobile wow wobble" data-wow-delay="1s" data-wow-duration="1s" id="fa-i"></i><br><br>
                      <span>Phone</span></h2><hr>
                      <p>+91 7031509154</p>
                    </div>
                </div>
                <div class="col-md-4 wow pulse">
                  <div class="light-box box-hover">
                    <h2><i class="fa fa-paper-plane wow lightSpeedIn" data-wow-delay="1s" id="fa-i"></i><br><br>
                      <span>Email</span></h2><hr>
                      <p>pustakalaya.ebook@gmail.com</p>
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
