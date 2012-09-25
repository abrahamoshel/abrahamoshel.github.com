<?php
//set your email here:
$yourEmail = 'your@email.fr';
/*
 * CONTACT FORM
 */
//If the form is submitted
if(isset($_POST['submitted'])) { 
    //Check to make sure that the name field is not empty
    if($_POST['contact_name'] === '') { 
            $hasError = true;
    } else {
            $name = $_POST['contact_name'];
    }
    //Check to make sure that the subject field is not empty
    if($_POST['contact_subject'] === '') { 
            $hasError = true;
    } else {
            $mail_subject = $_POST['contact_subject'];
    }

    //Check to make sure sure that a valid email address is submitted
    if($_POST['contact_email'] === '')  { 
            $hasError = true;
    } else if (!preg_match("/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i", $_POST['contact_email'])) {
            $hasError = true;
    } else {
            $email = $_POST['contact_email'];
    }

    //Check to make sure comments were entered	
    if($_POST['contact_textarea'] === '') {
            $hasError = true;
    } else {
            if(function_exists('stripslashes')) {
                    $comments = stripslashes($_POST['contact_textarea']);
            } else {
                    $comments = $_POST['contact_textarea'];
            }
    }

    //If there is no error, send the email
    if(!isset($hasError)) {

            $emailTo = $yourEmail ;
            $subject = $mail_subject;
            $body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
            $headers = 'From : my site <'.$emailTo.'>' . "\r\n" . 'answer to : ' . $email;

            mail($emailTo, $subject, $body, $headers);

            $emailSent = true; 
    }
    
}
/*
 * Newsletter
 */
if(isset($_POST['subscribe_submitted'])) { 
    //Check to make sure sure that a valid email address is submitted
    if($_POST['subscriber_email'] === '')  { 
            $subscribe_hasError = true;
    } else if (!preg_match("/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i", $_POST['subscriber_email'])) {
            $subscribe_hasError = true;
    } else {
            $subscriber_email = $_POST['subscriber_email'];
    }
    //If there is no error, write into newsletter_subscribers.txt
    if(!isset($subscribe_hasError)) {
            $newsletter_subscribers = fopen('newsletter_subscribers.txt', 'a');

            fputs($newsletter_subscribers, $subscriber_email."\n");

            fclose($newsletter_subscribers);
            

            $emailWritten = true; 
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Your Compagny - Coming soon</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        
        <!-- Stylesheet -->
        <link rel="stylesheet" href="styles/bootstrap.css" media="screen"  />
        <link rel="stylesheet" href="styles/bootstrap-responsive.css" media="screen"  />
        <link rel="stylesheet" href="styles/style.css">
        <link rel="stylesheet" href="styles/style_responsive.css">
	<!--[if IE]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
        <!--[if lt IE 9]> 
            <style type="text/css">
                /* Opacity bug */
                .timer_box, #contact_area{
                    background: #111;
                }
            </style>
        <![endif]-->
        
    </head>
    <body>
        <?php if(isset($emailSent) && $emailSent == true) { ?>
                <div class="alert-success alert" >
                    <a class="close" data-dismiss="alert" href="#">&times;</a>
                    <strong><?php echo'Thanks, '. $name  .'.';?></strong>
                        <p><?php echo'Your message was sent successfully. You will receive a response shortly.'; ?></p>
                </div><!-- .alert -->
	<?php } ?>
        <?php if(isset($hasError) && $hasError == true) { ?>
                <div class="alert-error alert">
                    <a class="close" data-dismiss="alert" href="#">&times;</a>
                    <strong><?php echo'Sorry,'; ?></strong>
                        <p><?php echo'Your message can\'t be send...check if your email is correct otherwise a field is missing...'; ?></p>
                </div><!-- .alert -->
	<?php } ?>
        <?php if(isset($emailWritten) && $emailWritten == true) { ?>
            <div class="alert-success alert">
                <a class="close" data-dismiss="alert" href="#">&times;</a>
                <strong><?php echo'Thanks you';?></strong>
                    <p><?php echo'Your e-mail was sent successfully.'; ?></p>
            </div><!-- .alert -->
	<?php } ?>
        <?php if(isset($subscribe_hasError) && $subscribe_hasError == true) { ?>
            <div class="alert-error alert">
                <a class="close" data-dismiss="alert" href="#">&times;</a>
                <strong><?php echo'Sorry,'; ?></strong>
                    <p><?php echo'Your email can\'t be send...check if your email is correct.'; ?></p>
            </div><!-- .alert -->
	<?php } ?>
	<div id="light"></div>
        <div id="page" class="container">
            <header class="center">
                <a href="#"><img src="images/logo.png" class="logo" title="Your logo"></a>
                <h1>Our website is coming soon...</h1>
            </header>
            <div class="separation"></div>
            
            <section id="timer" class="center">
                <p id="message"></p>
                <div id="days" class="timer_box"></div>
                <div id="hours" class="timer_box"></div>
                <div id="minutes" class="timer_box"></div>
                <div id="seconds" class="timer_box"></div>
                
                <div class="row">
                    <div class="span12 center" id="button_open_progress">
                        <div class="button_bg">
                            <button class="btn btn-large show_progress_area">We progress ! <i class="icon_grey icon-time"></i></button>
                        </div><!-- end .button_bg -->
                        <div class="open_me" id="open_me_progress">
                            <img src="images/open_me.png" title="Open me">
                        </div><!-- end .open_me -->
                    </div><!-- end .span12 -->
                    <div class="span12" id="progress_area">
                        <h2>We are here</h2>
                        <div id="progress_bar" class="button_bg">
                            <div class="progress progress-striped active span6 ">
                                <a href="#" rel="tooltip" title="70%"><div class="bar" style="width: 70%;"></div></a>
                            </div>
                            <div class="launch_day">
                                <img src="images/launch_day.png" title="Launch day">
                            </div><!-- end .launch_day -->
                        </div><!-- end .button_bg -->
                    </div><!-- end .span12 -->
                </div><!-- end .row -->
            </section><!-- end #timer -->
            <div class="separation"></div>
            
            <section id="container" class="es-carousel-wrapper">
                <div class="es-carousel">
                    <ul>
                        <li>
                            <div class="slide">
                                <div class="icon_container icon_1"><img src="images/1.png" alt=""></div>
                                <h2>Essential</h2>
                                <p>Design, simple, elegant, customizable, 100% responsive. This template is for you! Choose between 15 amazing backgrounds, customize your google map with your logo,
                                your social networks (28 available), import your logo, contact form...
                                </p>
                            </div><!-- end .slide -->
                        </li>
                        <li>
                            <div class="slide">
                                <div class="icon_container icon_2"><img src="images/2.png" alt=""></div>
                                <h2>Easy</h2>
                                <p>All the icons, backgrounds are included, for this slider you can choose between 20 icons liked by everyone, for every taste.
                                   Then this page is divided in large parts, so if you want to delate a part it's very easy...(progress area, contact area, container...).
                                </p>
                            </div><!-- end .slide -->
                        </li>
                        <li>
                            <div class="slide">
                                <div class="icon_container icon_3"><img src="images/3.png" alt=""></div>
                                <h2>Perfect</h2>
                                    <p>Here you're in a container box ! you see a slider but nothing prevents you to add delate it and add 6 columns, a table, a picture, a video... 
                                    Above you see a header area, put a headline to receive your future customers, then import your logo.
                                </p>
                            </div><!-- end .slide -->
                        </li>
                        <li>
                            <div class="slide">
                                <div class="icon_container icon_4"><img src="images/4.png" alt=""></div>
                                <h2>About us</h2>
                                <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum interdum eros eu lacus scelerisque eleifend pretium tellus malesuada.
                                    Nulla sem metus, posuere sed fermentum ut, ultrices eu lacus
                                </p>
                            </div><!-- end .slide -->
                        </li>
                        <li>
                            <div class="slide">
                                <div class="icon_container icon_5"><img src="images/5.png" alt=""></div>
                                <h2>We feel for everyone</h2>
                                <p>Etiam cursus iaculis turpis, ac tristique turpis commodo et. Suspendisse dui dui, pellentesque sed bibendum ac, hendrerit ac risus.
                                Maecenas consectetur egestas enim vel dapibus. Donec sed ante sed libero feugiat eleifend eget ut arcu.</p>
                            </div><!-- end .slide -->
                        </li>
                        <li>
                            <div class="slide">
                                <div class="icon_container icon_6"><img src="images/6.png" alt=""></div>
                                <h2>Let's get closer</h2>
                                    <p>Integer quis libero tortor, quis faucibus sem. Ut vitae lacus orci. Nullam viverra lobortis commodo. Nam leo leo, varius ac condimentum et, ultricies sit amet sem.
                                        Phasellus lobortis mauris nec tortor fringilla nec cursus lorem elementum.
                                </p>
                            </div><!-- end .slide -->
                        </li>
                    </ul>
                </div><!-- end .es-carousel-wrapper -->
            </section><!-- end #container -->
            <div class="separation"></div>
            
            <section id="additional">
                <div class="let_get_closer">
                    <img src="images/let_get_closer.png" title="Let's get closer">
                </div><!-- end .launch_day -->
                <div class="row">
                    <div class="span6 center">
                        <h2>Get ready</h2>
                        <div class="button_bg">
                            <form method="post" id="form_subscribe" action="index.php">
                                <input  id="appendedInputButtons" name="subscriber_email" class="span2 subscribe_input" size="24" type="text" placeholder="Your email goes here">
                                <input type="hidden" name="subscribe_submitted" id="subscribe_submitted" value="true" />
                                <button class="btn btn-large subscribe_button" type="submit" name="subscribe_submitted">Subscribe <i class="icon_grey icon-check"></i></button>
                            </form>
                        </div><!-- end .button_bg -->
                    </div><!-- end .span6 -->
                    <div class="span6 center">
                        <h2>We are social</h2>
                            <a href="#" rel="tooltip" title="Join us on facebook"><img src="images/icon_set/facebook.png" alt="facebook icon"  height="30" width="30" class="a_social_icon  facebook"></a>
                            <a href="#" rel="tooltip" title="Follow us on twitter"><img src="images/icon_set/twitter.png" alt="twitter icon" height="30" width="30" class="a_social_icon twitter"></a>
                            <a href="#" rel="tooltip" title="Join us on google +"><img src="images/icon_set/gplus.png" alt="gplus icon"  height="30" width="30" class="a_social_icon gplus"></a>
                            <a href="#" rel="tooltip" title="Join us on youtube"><img src="images/icon_set/youtube.png" alt="youtube icon"  height="30" width="30" class="a_social_icon youtube"></a>
                            <a href="#" rel="tooltip" title="Join us on vimeo"><img src="images/icon_set/vimeo.png" alt="vimeo icon"  height="30" width="30" class="a_social_icon vimeo"></a>
                            <a href="#" rel="tooltip" title="Subscribe our rss feed"><img src="images/icon_set/rss.png" alt="rss icon"  height="30" width="30" class="a_social_icon rss"></a>
                            <!-- disabled// choose yours !
                            <a href="#" rel="tooltip" title=""><img src="images/icon_set/addthis.png" alt="addthis icon"  height="30" width="30" class="a_social_icon addthis"></a>
                            <a href="#" rel="tooltip" title="Follow us on behance"><img src="images/icon_set/behance.png" alt="behance icon"  height="30" width="30" class="a_social_icon behance"></a>
                            <a href="#" rel="tooltip" title="Join us on blogger"><img src="images/icon_set/blogger.png" alt="blogger icon"  height="30" width="30" class="a_social_icon blogger"></a>
                            <a href="#" rel="tooltip" title="Join us on digg"><img src="images/icon_set/digg.png" alt="digg icon"  height="30" width="30" class="a_social_icon digg"></a>
                            <a href="#" rel="tooltip" title="Join us on dribbble"><img src="images/icon_set/dribbble.png" alt="dribbble icon"  height="30" width="30" class="a_social_icon dribbble"></a>
                            <a href="#" rel="tooltip" title="Follow us on flickr"><img src="images/icon_set/flickr.png" alt="flickr icon"  height="30" width="30" class="a_social_icon flickr"></a>
                            <a href="#" rel="tooltip" title="Join us on instagram"><img src="images/icon_set/instagram.png" alt="instagram icon"  height="30" width="30" class="a_social_icon instagram"></a>
                            <a href="#" rel="tooltip" title="Join us on lastfm"><img src="images/icon_set/lastfm.png" alt="lastfm icon"  height="30" width="30" class="a_social_icon lastfm"></a>
                            <a href="#" rel="tooltip" title=""><img src="images/icon_set/like.png" alt="like icon"  height="30" width="30" class="a_social_icon like"></a>
                            <a href="#" rel="tooltip" title="Follow us on linkedin"><img src="images/icon_set/linkedin.png" alt="linkedin icon"  height="30" width="30" class="a_social_icon linkedin"></a>
                            <a href="#" rel="tooltip" title="Join us on livejournal"><img src="images/icon_set/livejournal.png" alt="livejournal icon"  height="30" width="30" class="a_social_icon livejournal"></a>
                            <a href="#" rel="tooltip" title="Join us on myspace"><img src="images/icon_set/myspace.png" alt="myspace icon"  height="30" width="30" class="a_social_icon myspace"></a>
                            <a href="#" rel="tooltip" title="Join us on paypal"><img src="images/icon_set/paypal.png" alt="paypal icon"  height="30" width="30" class="a_social_icon paypal"></a>
                            <a href="#" rel="tooltip" title="Follow us on picasa"><img src="images/icon_set/picasa.png" alt="picasa icon"  height="30" width="30" class="a_social_icon picasa"></a>
                            <a href="#" rel="tooltip" title="Join us on reddit"><img src="images/icon_set/reddit.png" alt="reddit icon"  height="30" width="30" class="a_social_icon reddit"></a>
                            <a href="#" rel="tooltip" title="Join us on sharethis"><img src="images/icon_set/sharethis.png" alt="sharethis icon"  height="30" width="30" class="a_social_icon sharethis"></a>
                            <a href="#" rel="tooltip" title="Follow us on skype"><img src="images/icon_set/skype.png" alt="skype icon"  height="30" width="30" class="a_social_icon skype"></a>
                            <a href="#" rel="tooltip" title="Join us on spotify"><img src="images/icon_set/spotify.png" alt="spotify icon"  height="30" width="30" class="a_social_icon spotify"></a>
                            <a href="#" rel="tooltip" title="Join us on stumbleupon"><img src="images/icon_set/stumbleupon.png" alt="stumbleupon icon"  height="30" width="30" class="a_social_icon stumbleupon"></a>
                            <a href="#" rel="tooltip" title="Join us on tumblr"><img src="images/icon_set/tumblr.png" alt="tumblr icon"  height="30" width="30" class="a_social_icon tumblr"></a>
                            <a href="#" rel="tooltip" title="Follow us on wordpress"><img src="images/icon_set/wordpress.png" alt="wordpress icon"  height="30" width="30" class="a_social_icon wordpress"></a>
                            -->
                    </div><!-- end .span6 -->
                </div><!-- end .row -->
                <div class="row">
                    <div class="span12 center" id="button_open_contact">
                        <div class="button_bg">
                            <button class="btn btn-large show_contact_area">Contact us now ! <i class="icon_grey icon-envelope"></i></button>
                        </div><!-- end .button_bg -->
                        <div class="open_me" id="open_me_contact">
                            <img src="images/open_me.png" title="Open me">
                        </div><!-- end .open_me -->
                    </div><!-- end .span12 -->
                    <div class="span12" id="contact_area">
                        <h2>Contact us</h2>
                        <div class="row">
                            <div class="span6">
                                <form class="form-horizontal pull-left" method="post" id="form" action="index.php">
                                    <fieldset>
                                        <div class="control-group">
                                            <label class="control-label" for="contact_name">Name</label>
                                            <div class="controls"><input type="text" name="contact_name" class="input-xlarge" ></div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="contact_email">E-mail</label>
                                            <div class="controls"><input type="text" class="input-xlarge" name="contact_email"></div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="contact_subject">Subject</label>
                                            <div class="controls"><input type="text" name="contact_subject" class="input-xlarge"></div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="contact_textarea">Message</label>
                                            <div class="controls"><textarea name="contact_textarea" rows="6"></textarea></div>
                                        </div>
                                        <input type="hidden" name="submitted" id="submitted" value="true" />
                                        <div class="controls submit_button_bg pull-right"><button type="submit" class="btn" name="submitted">Send <i class="icon_grey icon-upload"></i></button></div>
                                    </fieldset>
                                </form>
                            </div><!-- end .span6 -->
                            <div class="span6">
                                <div id="GoogleMaps"></div>
                            </div><!-- end .span6 -->
                        </div><!-- end .row -->
                    </div><!-- end .span12 -->
                </div><!-- end .row -->
            </section><!-- end #additional -->
            <div class="separation"></div>
            
            <footer class="center">
                <p><strong>J-day</strong> &#169; 2012 All rights reserved | Designed by <a href="http://www.2f-design.fr">F&#178; </a>   <a href="#" class="scroll_top_a" rel="tooltip" title="Go to the top !"><i class=" icon-arrow-up icon-white"></i></a></p>
                <!-- Javascript files -->
                <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" ></script>
                <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
                <script type="text/javascript" src="js/main.js" ></script>
                <script type="text/javascript" src="js/jquery.elastislide.js" ></script>
                <script type="text/javascript" src="js/bootstrap-tooltip.js" ></script>
                <script type="text/javascript" src="js/bootstrap-alert.js" ></script>
            </footer><!-- end #footer -->
        </div><!-- end #page -->
    </body>
</html>