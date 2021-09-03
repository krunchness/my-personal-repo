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

 <!-- Overwrite Existing Page and URL and make it as Custom Post Type -->

 <?php 
// Register Product Custom Post Type
function product_post_type() {

    $labels = array(
        'name'                  => _x( 'Products', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Product', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Products', 'text_domain' ),
        'name_admin_bar'        => __( 'Products', 'text_domain' ),
        'archives'              => __( 'Product Archives', 'text_domain' ),
        'attributes'            => __( 'Product Attributes', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent Product:', 'text_domain' ),
        'all_items'             => __( 'All Products', 'text_domain' ),
        'add_new_item'          => __( 'Add New Products', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New Product', 'text_domain' ),
        'edit_item'             => __( 'Edit Product', 'text_domain' ),
        'update_item'           => __( 'Update Product', 'text_domain' ),
        'view_item'             => __( 'View Product', 'text_domain' ),
        'view_items'            => __( 'View Products', 'text_domain' ),
        'search_items'          => __( 'Search Product', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Featured Image', 'text_domain' ),
        'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into Product', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Product', 'text_domain' ),
        'items_list'            => __( 'Products list', 'text_domain' ),
        'items_list_navigation' => __( 'Products list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter Products list', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'Product', 'text_domain' ),
        'description'           => __( 'Product Custom Post Type', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions' ),
        'taxonomies'            => array( 'product_category', 'post_tag' ),
        'hierarchical'          => true,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => false,
        'rewrite' => array( 'slug' => 'products' ),
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type( 'product-cp', $args );

}
add_action( 'init', 'product_post_type', 0 );
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

<!-- Search String using array values -->
<?php
/* strpos that takes an array of values to match against a string
 * note the stupid argument order (to match strpos)
 */

//Update: Improved code with stop when the first of the needles is found:
function strposa($haystack, $needle, $offset=0) {
    if(!is_array($needle)) $needle = array($needle);
    foreach($needle as $query) {
        if(strpos($haystack, $query, $offset) !== false) return true; // stop on first true result
    }
    return false;
}
$string = 'Whis string contains word "cheese" and "tea".';
$array  = array('burger', 'melon', 'cheese', 'milk');
var_dump(strposa($string, $array)); // will return true, since "cheese" has been found




// Another Example:

function strpos_arr($haystack, $needle) {
    if(!is_array($needle)) $needle = array($needle);
    foreach($needle as $what) {
        if(($pos = strpos($haystack, $what))!==false) return $pos;
    }
    return false;
}

$needle = array('something','nothing');
$haystack = "This is something";
echo strpos_arr($haystack, $needle); // Will echo True

$haystack = "This isn't anything";
echo strpos_arr($haystack, $needle); // Will echo False 
?>


<!-- Filter or Search Multidimentional Array -->
<?php 
  $filterBy = '25x25'; // or Finance etc.

  $new = array_filter($products_info, function ($var) use ($filterBy) {
      return ($var['cmb_product_size_text'] == $filterBy);
  });
echo '<pre>';
var_dump($new);
echo '</pre>';
?>




<!-- Simple Accordion -->

<script>
  $('.toggle').click(function(e) {
      e.preventDefault();
    
      var $this = $(this);
    
      if ($this.next().hasClass('show')) {
          $this.next().removeClass('show');
          $this.next().slideUp(350);
      } else {
          $this.parent().parent().find('li .inner').removeClass('show');
          $this.parent().parent().find('li .inner').slideUp(350);
          $this.next().toggleClass('show');
          $this.next().slideToggle(350);
      }
  });
</script>

<style>
  ul {
    list-style: none;
    padding: 0;
    width: 80%;
    .inner {
        padding-left: 1em;
        overflow: hidden;
        display: none;
      
        &.show {
          /*display: block;*/
        }
    }
  
    li {
        margin: .5em 0;
      
        a.toggle {
            width: 100%;
            display: block;
            background: rgba(161, 155, 155, 0.8);
            color: #fefefe;
            padding: .75em;
            border-radius: 0.15em;
            transition: background .3s ease;
          
            &:hover {
                background: rgba(0, 0, 0, 0.9);
            }
        }
    }
}
</style>

<!-- HTML Code of Simple Accordion -->
<ul class="accordion">
  <li>
      <a class="toggle" href="javascript:void(0);">{{ selected.brandType.name }} Account</a>
      <ul class="inner fxuser_container">
      </ul>
  </li>
<li>
      <a class="toggle" href="javascript:void(0);">Required Plugins</a>  
      <ul class="inner plugins_container">
      </ul>
 </li>
 <li>
      <a class="toggle" href="javascript:void(0);">Deactivated Plugins</a>  
      <ul class="inner deactivated_plugins">
      </ul>
 </li>
</ul> 


<!-- Search for string inside a variable -->
<?php 
strpos($fx_user[0]->user_login, $brand_user['abbreviation'].'-webmaster' ) !== false
 ?>

 <!-- Load More on Button Click -->
 <script>

  $(".events-list li, .location-list li").slice(0, 3).show();
  $(".location-list li").slice(0, 3).show();
  $(".view-more-btn").on('click', function (e) {
    e.preventDefault();
    $(".events-list li:hidden").slice(0, 3).slideDown();
    $(".location-list li:hidden").slice(0, 3).slideDown();
    if ($(".events-list li:hidden, .location-list li:hidden").length == 0) {
      $(".view-more-btn").fadeOut('slow');
    }
  });
 </script>

  <?php $args = array(
    'post_type' => 'events',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'DESC',

  ); 

  $query_events = new WP_Query( $args ); ?>
  <div class="large-6 columns">
    <div class="events-container">
      <h2>Events</h2>
    </div>
    <div class="events-list-container">
      <ul class="events-list">
        <?php //for ($i=1; $i <= 3 ; $i++) {  ?>
          <!-- <li class="events-list-item">test</li> -->
        <?php if ($query_events->have_posts()): ?>
          <?php $event_count = 0; ?>
          <?php while ($query_events->have_posts()): $query_events->the_post(); ?>
            <?php $thumbnail = get_the_post_thumbnail_url(); ?>
            <?php $img = ($thumbnail != false ? get_the_post_thumbnail_url() : $fx_data['gallery_thumbnail']['url']); ?>
            <?php $event_count++; 

            $date = get_post_meta( get_the_ID(), 'cmb_events_date', true );?>
            <li class="events-list-item event-<?php echo $event_count; ?>">

              <?php 

              $title = get_post_meta( get_the_ID(), 'cmb_location_title', true );

               ?>

              <div class="row">
                <div class="large-12 columns">
                  <div class="event-content">
                    <h2><?php the_title(); ?></h2>
                    <p class="event-date">Date: <?php echo $date; ?></p>
                    <p class="event-desc">Location: <?php echo $title; ?> </p>
                  </div>
                  <?php $temp_loc = '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6872904.100801892!2d145.55863879391765!3d-32.741574961659644!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b0dcb74f75e4b0d%3A0x1780af1122c49f2d!2sNew+South+Wales%2C+Australia!5e0!3m2!1sen!2sph!4v1515554370463" width="450" height="130" frameborder="0" style="border:0" allowfullscreen></iframe>';

                  $location = get_post_meta( get_the_ID(), 'cmb_event_location', true );

                  $location = ($location != ''? $location : $temp_loc);
                  ?>

                  <div class="map-container hide-desktop">
                    <?php echo $location; ?>
                  </div>
                </div>
              </div>
            </li>
          <?php endwhile; ?>
          <?php wp_reset_query(); ?>
        <?php endif; ?>
      </ul>
    </div>
  </div>

  <div class="large-6 columns mobile-hidden">
    <div class="locations-container">
      <h2>Locations</h2>
    </div>

     <div class="location-list-container">
      <ul class="location-list"> 
        <?php if ($query_events->have_posts()): ?>
          <?php $class_count = 0; ?>
          <?php while ($query_events->have_posts()): $query_events->the_post(); ?>
            <?php $class_count++; ?>
            <li class="location-list-item location-<?php echo $class_count; ?>">

            <?php $temp_loc = '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6872904.100801892!2d145.55863879391765!3d-32.741574961659644!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b0dcb74f75e4b0d%3A0x1780af1122c49f2d!2sNew+South+Wales%2C+Australia!5e0!3m2!1sen!2sph!4v1515554370463" width="450" height="130" frameborder="0" style="border:0" allowfullscreen></iframe>';

            $location = get_post_meta( get_the_ID(), 'cmb_event_location', true );

            $location = ($location != ''? $location : $temp_loc);
            ?>
              <div class="map-container">
                <?php echo $location; ?>
              </div>
            </li> 
          <?php endwhile; ?>
          <?php wp_reset_query(); ?>
        <?php endif; ?>
        
      
       </ul>
    </div>
  </div>


  <a href="#" title="View more Events" alt="View more Events" class="view-link">
     <button class="view-more-btn">View More Events</button>
  </a>
  



<!-- Allow SVG Format in wordpress -->
<?php 

function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

 ?>



<!-- Add Toolbar at the top of header -->

<!-- Add this Inside of Header -->
<div class="toolbar mobile-only">
  <div class="row">
    <div class="toolbar-content">
      <div class="small-12 columns">
        <div class="call-enquiry">
          <span class="enquiry-assistance">FOR ASSISTANCE/ENQUIRY</span>
          <a href="tel:0297572666">
            <span class="enquiry-callnum">CALL 02 9757 2666</span>
          </a>
        </div>
      </div>
    </div>
    <div class="small-12 columns">
      <div class="toolbar-toggle-wrap">
        <span class="toggle-arrow">
          <i class="fa fa-chevron-down" aria-hidden="true"></i>
        </span>
      </div>
    </div>
  </div>
</div>

<!-- CSS -->
<style>
  .toolbar {
    text-align: center;
    padding-top: 5px;
}

.toolbar-content {
    display: none;
}

.toolbar-toggle-wrap {
    font-size: 20px;
    color: #fff;
}
</style>

<!-- Script -->
<script>
  //toggle-top
  $( ".toggle-arrow" ).click(function() {
    $( ".toolbar-content" ).toggleClass( "toggle-top" ).slideToggle("500, linear");
    
  });
</script>

<!-- Contact form Recaptcha Overflow on small-width -->
<style type="text/css">
  transform: scale(0.8); 
  -webkit-transform: scale(0.8); 
  transform-origin: 0 0; 
  -webkit-transform-origin: 0 0;
</style>



<!-- Add Category Image Metabox Using CMB2  -->
<?php 
$cmb_additionial_info = new_cmb2_box( array(
        'id'           => $prefix . 'product_cat_info',
        'title'        => esc_html__( 'Additional Info', 'cmb2' ),
        'object_types' => array( 'term' ), // Post type
        'taxonomies' => array( 'product_category' ),
        'context'      => 'side', // normal, side
        'priority'     => 'low', // low, high
        'show_names'   => true, // Show field names on the left
    ) );

    $cmb_additionial_info->add_field( array(
    'name'         => esc_html__( 'Category Image', 'cmb2' ),
    'desc'         => esc_html__( 'Upload Images.', 'cmb2' ),
    'id'           => $prefix . 'cat_file',
    'type'         => 'file',
    'options' => array(
      'url' => false, // Hide the text input for the url
    ),
    'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
  ) );


 ?>

<script>
 /* Check if Element is visible on scroll*/
 if ($('.page-id-96').visible(true)) {
	  		$.fn.isInViewport = function() {
			  var elementTop = $(this).offset().top;
			  var elementBottom = elementTop + $(this).outerHeight();

			  var viewportTop = $(window).scrollTop();
			  var viewportBottom = viewportTop + $(window).height();

			  return elementBottom > viewportTop && elementTop < viewportBottom;
			};
			$(window).on('resize scroll', function() {
				$('.history-list').each(function() {
				    if ($(this).isInViewport()) {
				      $(this).removeClass('disabled');
				    } else {
				      $(this).addClass('disabled');
				    }
				  });
			}
	  } 
</script>

				     
// Ajax Request from functions.php wordpress

<script>
    var ajax_url = ajax_params.ajax_url; // so we access our ajax_url through the ajax_params object
    var data = {
	action: 'filter_post_form',
	form_data: $('.filter_post_form').serialize(),
	filter_type: radio_value
    };

    $.post(ajax_url, data, function(response) {
	$('.postform-filter-row').empty();
	$('.postform-filter-row').append(response);
	// console.log(response);
    });			     
</script>
wp_localize_script( 'custom-scripts', 'ajax_params', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
	 
add_action('wp_ajax_filter_post_form', 'filter_post_form');
add_action('wp_ajax_nopriv_filter_post_form', 'filter_post_form');

function theme_pto_posts_orderby($ignore, $orderBy, $query)
  {
      if( (! is_array($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'post') || 
              (is_array($query->query_vars)   &&  in_array('post', $query->query_vars)))
              $ignore = TRUE;
      
      
      return $ignore;
  }
