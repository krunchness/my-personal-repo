<?php 
/********************************* EXAMPLES ****************************/
 ?>

//pass: M@ur!c3M0ss2006

<!-- Custom Post Type Generator -->
https://generatewp.com/post-type
<!-- SlickNavigation for Mobile -->
http://slicknav.com/

<!-- Intranet
Username : nelson
password : 1 -->


<!-- 
WPMU DEV
User:brooke@gingercreative.com.au
Pass:Bj2siV6tWR67 -->


<!-- Hamburger Menu -->
https://jonsuh.com/hamburgers/
<script>

  // Look for .hamburger
  var hamburger = document.querySelector(".hamburger");
  // On click
  hamburger.addEventListener("click", function() {
    // Toggle class "is-active"
    hamburger.classList.toggle("is-active");
    // Do something else, like open/close menu
  });
</script>


<?php     
# How to Output Metabox 2: Group
$group_values =  get_post_meta(get_the_ID(), "GroupID", true);
if($group_values): ?>
   <?php
   foreach($group_values as $group):
   # DeclareValue
   $group_name = $group['PostTypeID'];
   $group_description = $group['PostTypeID'];
   $group_image = $group['PostTypeID'];
   ?>
      <!-- Show -->
   <?php
   endforeach;
   ?>
<?php else: ?>  
   <!-- False -->
   <span>False</span>
<?php endif; ?>   

<?php 
# Enqueue Style And Scripts
   wp_enqueue_style( 'my-style', get_template_directory_uri() . '/css/myStyle.css');
   wp_enqueue_script( 'myJs', get_template_directory_uri() . '/js/myJs.js', array(), null, true );
 ?>

<?php 
# Register Menu in Function.php
function register_my_menu() {
  register_nav_menu('topheader-menu',__( 'Top Header Menu' ));
}
add_action( 'init', 'register_my_menu' );

# How to use in Templates

//wrap inside div
wp_nav_menu(array('theme_lecation' => 'topheader-menu' , 'menu_class' => 'menu'));
 ?>

<?php 

//Include CMB2
require get_template_directory() . '/inc/CMB2/init.php';

add_action( 'cmb2_admin_init', 'myCMB' );
/**/
function myCMB() {
   $prefix = 'fx-';

   $cmb2 = new_cmb2_box( array(
      'id'            => $prefix . 'metabox',
      'title'         => esc_html__( 'About Section', 'cmb2' ),
      'object_types'  => array( 'page', ), // Post type
      'show_on'       => array(
            'id' => array('4'),
         ),
     ) );

   $cmb2->add_field( array(
      'name'    => 'About Image',
      'desc'    => 'Upload an image or enter an URL.',
      'id'      => $prefix . 'about-img',
      'type'    => 'file',
      // Optional:
      'options' => array(
         'url' => false, // Hide the text input for the url
      ),
      'text'    => array(
         'add_upload_file_text' => 'Add File' 
      ),
   ) );

}
//Function for outputs
function output_cmb($id){
   $cmb2 = get_post_meta( get_the_ID(), $id, 'true' );

   return $cmb2;
}

# Output CMB2 In templates
echo output_cmb($id);
 ?>


<?php 
# Require for redux
require get_template_directory() . '/admin/admin-init.php';
 ?>

 <?php 
# Require Mobile Detect
 require_once('inc/Mobile_Detect.php');

/**
 * Mobile detect for mobile.
 */
function is_mobile(){
   $detect = new Mobile_Detect;
   $result = false;
   
   if ( $detect->isMobile() && !$detect->isTablet()  ):
      $result = true;
   endif;
   
   return $result;
}

function is_tablet_ipad(){
   $detect = new Mobile_Detect;
   $result = false;
   
   if ( $detect->version('iPad') && $detect->isTablet()  ):
      $result = true;
   endif;
   
   return $result;
}

/**
 * Mobile detect scripts.
 */
function mobile_detect_scripts() {
   $detect = new Mobile_Detect;
   if ( $detect->isMobile() && !$detect->isTablet() ) { 
      
      //mobile JS
      wp_register_script( 'mobile-js', get_template_directory_uri() . '/js/mobile-site.js', array( 'jquery' ), '1', false );
      wp_enqueue_script( 'mobile-js' );
            
      //mobile style
      wp_register_style( 'mobile-style', get_template_directory_uri() . '/css/mobile.css', array(), '1', 'all' );
      wp_enqueue_style( 'mobile-style' );
      
   } else {
      //responsive style
      wp_register_style( 'responsive-style', get_template_directory_uri() . '/css/responsive.css', array(), '1', 'all' );
      wp_enqueue_style( 'responsive-style' );
   }
}

add_action( 'wp_enqueue_scripts', 'mobile_detect_scripts' );




# Add in Header File <head> tag
  ?>
<?php if ( is_mobile() ):  ?>
    <!-- MobileView -->
    <meta name="viewport" content="width=541" >
<?php elseif(is_tablet_ipad()): ?>
    <!-- DesktopView -->
    <meta name="viewport" content="width=1200" >
<?php else:  ?>
    <!-- Responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
<?php endif;  ?>



<!-- get attachment alt text -->
<?php 
function get_attachment_id_by_src ($image_src) {

    global $wpdb;
    $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
    $id = $wpdb->get_var($query);
    return $id;

}

function get_image_title_by_id($image_src){
  $attch_id = get_attachment_id_by_src($image_src);
  $title_text = get_the_title($attch_id);
  return $title_text;
}

$attch_id = get_attachment_id_by_src($attch_url);
$title_text = get_the_title($attch_id);
$alt_text = get_post_meta( $attch_id, '_wp_attachment_image_alt', true );

 ?>

<!-- Redux Slider -->
<?php 
Redux::setSection( $opt_name, array(
        'title'  => __( 'Sliders', 'redux-framework' ),
        'id'     => 'fx-slider',
        'desc'   => __( 'Homepage Sliders Option', 'redux-framework' ),
        'icon'   => 'el el-picture',
        'fields' => array(
            array(
                'id'       => 'fx-slide-chckbx',
                'type'     => 'checkbox',
                'title'    => __('Enable Slider', 'redux-framework'), 
                'subtitle' => __('', 'redux-framework'),
                'desc'     => __('Check to enable slider in Homepage', 'redux-framework'),
                'default'  => '1'// 1 = on | 0 = off
            ),
            array(
                'id'          => 'fx-slider-opt',
                'type'        => 'slides',
                'title'       => __('Slides Options', 'redux-framework'),
                'subtitle'    => __('Unlimited slides with drag and drop sortings.', 'redux-framework'),
                'desc'        => __('This field will store all slides values into a multidimensional array to use into a foreach loop.', 'redux-framework'),
                'placeholder' => array(
                    'title'           => __('This is a title', 'redux-framework'),
                    'description'     => __('Description Here', 'redux-framework'),
                    'url'             => __('Give us a link!', 'redux-framework'),
                ),
            ),
        ),
    ) );

?>
<!-- LightSlider With Content Inside -->
 <section id="front-page-slider">
  <ul id="slides" class="lightSlider">
    <?php if (isset($redux_data['fx-slider-opt']) && !empty($redux_data['fx-slider-opt'])) { ?>
      <?php foreach ($redux_data['fx-slider-opt'] as $fx_slider): ?>
      <?php $img = $fx_slider['image']; ?>
        <li class="text-center">
          <div class="content-wrap">
            <div class="row">
              <p class="slide-title">GARDEN CARE is our true passion!</p>
              <p class="slide-desc">SO WHENEVER YOU JUST FEEL YOU NEED A PROFESSIONAL HELPING HAND AT YOUR GARDEN, CALL US UP!</p>
              <a href="#" class="float-center"><button>Find Out More</button></a>
            </div>
          </div>
          
          <img src="<?php echo $img; ?>" />
        </li>
      <?php endforeach; ?>
    <?php } ?>
  </ul>
  
</section>


<!-- Lightslider Styles in CSS with inner content -->
#front-page-slider {
    position: relative;
}

.lSPager.lSpg {
    position: absolute;
    bottom: 10px;
    margin: 0 auto;
    left: 0;
    right: 0;

    li.active a {
        background-color: #ffffff;
    }

    li a {
        background-color: transparent;
        border: 2px solid white;
    }
}

ul#slides {
    li {
        position: relative;

        .content-wrap {
            position: absolute;
            color: white;
            margin: 0 auto;
            left: 0;
            right: 0;
        }
    }
}

.slide-text {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;

    .slide-wrapper {
        display: table;
        width: 100%;
        height: 100%;
    }
}

.slide-content {
    display: table-cell;
    vertical-align: top;
    padding: 5% 0 0;
    color: #ffffff;

    .slider-txt-wrap {
        padding-top: 7%;
    }

    .slide-title {
        p {
            font-size: 4em;
        }
    }

    .desktop {
        margin-right: 72px;
        padding-top: 25px;
    }
}

.slide-desc {
    p {
        font-size: 19px;
        border-left: 4px solid #9fe6e4;
        padding-left: 30px;
    }

    button {
        width: 190px;
        height: 50px;
        font-size: 19px;
        background-color: #ebebeb;
        color: #5cbfbc;
        border-radius: 5px;
        margin-top: 30px;

        &:hover {
            background: #9fe6e4;
            color: #fff;
            transition: all 0.3s;
        }
    }
}
<?php  ?>

<!-- Pass JSON data php to external file  -->
<?php 
add_action("wp_enqueue_scripts","my_scripts_loader");
  
function my_scripts_loader(){
    $data = array("home"=>site_url());
 
    wp_enqueue_script("myscript","path/to/my/script.js");
    wp_localize_script( "myscript", "blog", $data );
 
}


// in external js file
alert(blog.home);
 ?>

 <!--Wordpress Dropdown Desktop/Tablet Header menu css  -->
<style>
  .menu-item-has-children {
    position: relative;

    &:hover {
        .sub-menu {
            display: block;
            position: absolute;
            z-index: 9999;
            width: 300px;
            background: #66AB36;
        }
    }
}

.sub-menu {
    display: none;
    list-style: none;
    padding: 25px 0 15px 10px;
    li {
        padding-left: 0;
        padding-bottom: 10px;
        > a {
            border-bottom: none;
            color: #ffffff;

        }
    }
}
</style>


<!-- contact form 7 required fields -->
<style>
  /*fields placeholder paddings */
input[type="text"], 
input[type="email"], 
*::placeholder, 
textarea[rows]{
    padding-left: 10px;
}

/*submit button style*/
input[type="submit"] {
    padding: 10px 35px;
    font-size: 1em;
    background: #66AB36;
    color: #ffffff;
    border-radius: 10px;
}
</style>


<!-- mobile/tablet navigation menu using hamburger.js -->
<!-- Hamburger Header -->
<div class="medium-76 small-6 column hamburg">  
  <div class="hamburger-container">
    <div class="hamburger hamburger--spin-r js-hamburger">
      <div class="hamburger-box">
        <div class="hamburger-inner"></div>
      </div>
    </div>
  </div>
</div>

<!-- Hamburger JS -->
<script>
  // Look for .hamburger
  var hamburger = document.querySelector(".hamburger");
  // On click
  hamburger.addEventListener("click", function() {
    // Toggle class "is-active"
    hamburger.classList.toggle("is-active");
    // Do something else, like open/close menu
  });

    $( ".hamburger" ).click(function() {

      $( ".row-menu" ).toggleClass( "toggle" ).slideToggle("slow");
    });

    $('.mobile.fa-times').click(function() {
      $('.row-menu').slideToggle("slow");
      $('.hamburger--spin-r').removeClass('is-active');
  });


  //Hide Mobile Menu When viewport/screen size is 769 up
  $(window).resize(function() {

    var viewportWidth = $(window).width();

    if (viewportWidth >= 770) {
      $('.row-menu.toggle').css({display: 'none'});

        if(($('.js-hamburger').hasClass('is-active') && $('.row-menu').hasClass('toggle'))){
          $('.js-hamburger').removeClass('is-active');
          $('.row-menu').removeClass('toggle');
        }
    }

  });
</script>

<!-- when hamburger is clicked -->
<div class="row row-menu">
      <div class="row align-right">
        <div class="medium-4 small-4 column">
            <strong class="strong-menu">MENU</strong>
          </div>
          <div class="medium-4 small-4 column">
            <div class="mobile fa fa-times float-right"></div> 
        </div>
      </div>
    <div class="medium-12 small-12 column mobile menu">
        <div class="menu-mobile-menu-container">
            <?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'toggle-menu' ) ); ?>
        </div>
    </div>
  </div>

<!-- style for menu when active -->
<style>
  .row-menu {
        background-color: rgba(46, 60, 121, 0.9);
        position: fixed;
        width: 100%;
        height: 100%;
        z-index: 100;
        clear: both;
        left: 0;
        right: 0;
        text-align: center;
        top: 0;
        padding-top: 25px;
        color: #ffffff;
        display: none;
    }

    .mobile.menu {
        display: block;
        margin-top: 1.5em;
    }

    #toggle-menu {
        li {
            display: block;
            margin-bottom: 3em;
        }

        li > a {
            display: block;
            text-align: center;
            border-bottom: none;
            color: #ffffff;
            font-size: 1.30em;
        }
    }

    .strong-menu {
        font-size: 1.5em;
        font-size: 2em;
    }
</style>
<!-- mobile navigation end codes-->

<!-- get the value of width when browser is resized -->
<script>
  $(window).resize(function() {

    var viewportWidth = $(window).width();

    console.log(viewportWidth);
  });
</script>




<!-- custom post type generator  -->
https://generatewp.com/post-type/

<!-- Custom Post type -->
<?php 
  $args = array(
      'label'                 => __( 'Service', 'text_domain' ),
      'description'           => __( 'Services Description', 'text_domain' ),
      'labels'                => $labels,
      'supports'              => array( 'title', 'editor' , 'excerpt', 'revisions', ),
      'taxonomies'            => array( 'category', 'post_tag' ),
      'hierarchical'          => false,
      'public'                => true,
      'show_ui'               => true,
      'show_in_menu'          => true,
      'menu_position'         => 5,
      'show_in_admin_bar'     => true,
      'show_in_nav_menus'     => true,
      'can_export'            => true,
      'has_archive'           => true,    
      'exclude_from_search'   => false,
      'publicly_queryable'    => true,
      //change url instead of its default set slug or post type
      'rewrite' => array( 'slug' => 'service' ),
      'capability_type'       => 'page',
   );
 ?>


 <!-- Include JQuery Locally -->
<?php 

  wp_deregister_script( 'jquery' );
  wp_enqueue_script( 'jquery-external', get_template_directory_uri().'/js/jquery-3.2.1.min.js', array(), '3.2.1', false );

 ?>


 <!-- BFI Thumb -->

 <?php
//Require BFI Thumb
require_once('BFI_Thumb.php');

 //Parameters
 $params = array( 'width' => 400, 'height' => 300 );
bfi_thumb( "URL-to-image.jpg", $params );
  ?>




  <!-- Add Column to Post List -->
<?php 

//Add New Column To Post List
add_filter( 'manage_posts_columns', 'jobs_managing_my_posts_columns', 10, 2 );
function jobs_managing_my_posts_columns( $columns, $post_type ) {
   if ( $post_type == 'jobs' )
      $columns[ 'recommended_jobs' ] = 'Recommended';
   return $columns;
} 


//Content of New Column
add_action( 'manage_posts_custom_column', 'jobs_populating_my_posts_columns', 10, 2 );
function jobs_populating_my_posts_columns( $column_name, $post_id ) {
   switch( $column_name ) {
      case 'recommended_jobs':
        $recommended_text = (get_post_meta( $post_id, 'recommended_job', true ) == on ? 'Yes' : 'No' );
         echo '<div style="margin-left: 30%;" id="recommended_job' . $post_id . '">'.$recommended_text.'</div>';
         break;
   }
} ?>



<!-- Sticky Quick Enquiry -->
<span class="sticky-button-position show-for-large ">
    <span data-remodal-target="remodal-enquiry" class="button">Quick Enquiry</span>
  </span>

<style>
  .sticky-button-position {
    -moz-transform: rotate(-90deg);
    -o-transform: rotate(-90deg);
    -ms-transform: rotate(-90deg);
    -webkit-transform: rotate(-90deg);
    transform: rotate(-90deg);
    position: fixed;
    right: -4%;
    top: 35%;
    z-index: 100;

    .button {
        font-size: 1.2rem;
        margin: 0 0 0rem;

        /*Include These if not using foundation.min.css*/
        display: inline-block;
        vertical-align: middle;
        padding: .85em 1em;
        -webkit-appearance: none;
        border: 1px solid transparent;
        border-radius: 3px;
        transition: background-color .25s ease-out,color .25s ease-out;
        line-height: 1;
        text-align: center;
        cursor: pointer;
        background-color: #2ba6cb;
        color: #fefefe;
    }
}
</style>


<!-- Add Preview Image Before Upload -->

<input id="file_upload" name="image" type="file">
<img id="image" width="150" />

<script> 
$('#file_upload').change(function () {
    var reader = new FileReader();
        reader.onload = function (e) {
            // get loaded data and render thumbnail.
            $('#image').attr('src', e.target.result);
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    });
</script>


<!-- Wait for Div To Load and Run Next Function Inside -->
<script>
  function waitForElement(elementPath, callBack){
    window.setTimeout(function(){
      if($(elementPath).length){
        callBack(elementPath, $(elementPath));
      }else{
        waitForElement(elementPath, callBack);
      }
    },500)
  }

  waitForElement("#myDiv",function(){
    console.log("done");
  });
</script>

<!-- Use HTML inside Shortcode -->
<?php 
function ourteam_shortcode() {
   ob_start(); ?>
   <div id="ourteam">
      <div class="row">
         <h2 class="large-12 columns text-center">
            <?php echo output_cmb('team-heading'); ?>
         </h2>

         <?php $staffs = output_cmb('team_group');
               foreach ( (array) $staffs as $key => $staff ) { 
                  $photo = $staff['team-image'];
                  $name = $staff['team-name'];
                  $position = $staff['team-position'];
                  $bio = $staff['team-bio']; ?>

            <div class="large-4 columns">
               <div class="grey-wrap">
               <div class="row">
                  <div class="large-12 columns text-center">
                     <div class="team-img">
                        <img src="<?php echo $photo; ?>" alt="<?php echo get_image_alt_by_src($photo); ?>" title="<?php echo get_image_title_by_id($photo); ?>">
                     </div>
                     <span class="team-name"><?php echo $name;?></span>
                     <span class="team-position"><?php echo $position;?></span>
                  </div>
                  <div class="large-12 columns">
                     <div class="team-bio">
                        <?php echo wpautop($bio);?>
                     </div>
                  </div>
               </div>
            </div>
            </div>
         <?php } ?>
      </div>
   </div>
   <?php return ob_get_clean();
}
add_shortcode( 'our_team', 'ourteam_shortcode' );
 ?>