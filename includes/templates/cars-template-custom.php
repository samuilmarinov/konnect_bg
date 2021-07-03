<?php 
//Template  Cars Custom
$booking = $_GET['book'];
$driver = $_GET['driver'];
$booking_service = 'Drivers';
if($booking != ''){
    
 $classshow = str_replace(" ", "", $booking);  
 $dot = ".";
 $displaynone = '{display:block !important;}';
 $command = $dot.$classshow.$displaynone;
 
 echo '<style>.section-row{display:flex;} .hidden_cta{display:block !important;} .cta{display:none !important;} .heading-scooters, .service{display:none !important; min-width: 350px;}'. $command .'</style>';   
}


$args = array(
    'post_type'=> 'cars',
    'order'    => 'DESC',
    'orderby' => 'post_date',
    'posts_per_page' => 3
); 

?>
<style>
.attachment-thumbnail{
    height: 100%;
    width: 100%;
}
.service > ul{list-style:none;}
.section-lead {
  max-width: 600px;
  margin: 1rem auto 1.5rem;
}

.service a {
  color: #5b7abb;
  display: block;
}

.service h4 {
  font-family: 'Montserrat', sans-serif;
  font-weight: 600;
  color: #56ceba;
  font-size: 1.3rem;
  margin: 1rem 0 0.6rem;
}

.services-grid {
  display: -webkit-box;
  display: flex;
  -webkit-box-align: center;
  align-items: center;
}

.service {
  margin: 20px;
  padding: 20px;
  border-radius: 4px;
  text-align: left;
  -webkit-box-flex: 1;
  flex: 1;
  display: -webkit-box;
  display: flex;
  flex-wrap: wrap;
  border: 2px solid #e7e7e7;
  -webkit-transition: all 0.3s ease;
  -moz-transition: all 0.3s ease;
  transition: all 0.3s ease;
}

.service:hover {
  -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.08);
  -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.08);
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.08);
}

.service i {
  font-size: 3.45rem;
  margin: 1rem 0;
}

.service i,
.service h4,
.service .cta {
  color: #42b7ca;
}

.service:hover {
  border: 2px solid #42b7ca;
}


.service .cta span {
  font-size: 0.6rem;
}

.service > * {
  flex: 1 1 100%;
}

.service .cta {
  align-self: flex-end;
}

.hidden_cta{
    background:#f1c672;
    color: white !important;
    padding: 10px;
}
.cta{
    background: #ee614e;
    color: white !important;
    padding: 10px;
}
.hidden_cta::before{
    content: " <";
}
.cta::after {
  content: " >";
}
 @media (max-width: 480px) {.section-row { display: inherit !important; } .page-content { padding: 3%; }
     
 }
@media all and (max-width:900px) {
  .services-grid {
    display: -webkit-box;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    flex-direction: column;
  }
}
</style>
<section>
<div class="services-grid">
<? $the_query = new WP_Query( $args );
if($the_query->have_posts() ) : 
    while ( $the_query->have_posts() ) : 
       $the_query->the_post(); 
       $ttle = get_the_title();
       $theid = get_the_ID() ;?>
        <div class="service <?php echo str_replace(" ", "", $ttle); ?>">
        <?php echo get_the_post_thumbnail( $page->ID, 'thumbnail' ); ?>
          <h4><?php the_title(); ?></h4>
          <p><?php the_content(); ?></p>
         <a href="/driver?driver=<?php echo $driver;?>&book=<?php the_title(); ?>&service=<?php echo $booking_service; ?>" class="cta">Book Now<span class="ti-angle-right"></a>
        </div>
   <? endwhile; 
    wp_reset_postdata(); 
else: 
endif;
?>
</div>
</section>