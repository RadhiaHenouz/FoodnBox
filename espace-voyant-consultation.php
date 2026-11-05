<?php
/**
 * Template Name: Consultation - Espace voyant
 */


get_header();
?>


    <section id="primary" class="content-area full">
        <main id="main" class="site-main" role="main">
            <div class="container">
            	<div class="row">
            		<div class="bandeau-account col-md-12 col-xs-12">
            			<?php echo do_shortcode( '[elementor-template id="2341"]' ); ?>
             		</div>
             		
             			<div class="column-customer col-lg-12 col-md-12 col-xs-12">
             				<div class="bloc-left-page col-lg-8 col-md-12 col-xs-12">
             					
             						<div class="bloc-breadcrumbs col-md-12 col-xs-12">
             							<?php echo do_shortcode( '[elementor-template id="2314"]' ); ?>
             						</div>

             		 					<div id="consultation_table" class="bloc-profil col-md-12 col-xs-12">
             		 							<?php echo do_shortcode( '[elementor-template id="2888"]' ); ?>
             		 							
             		 					</div>						
             		 		</div>		
					
							
							<div class="bloc-right col-lg-4 col-md-12 col-xs-12">
								
             						<div class="menu-bloc col-md-12 col-xs-12">
             							<?php echo do_shortcode( '[elementor-template id="483"]' ); ?>
             								<div>
             		 				</div>
             		 				
							</div>
						</div>		
				</div>
           	</div>
        </main><!-- #main -->
    </section><!-- #primary -->
    
   
<?php

get_footer();
?>
<script>
 function detailFormatter(index, row) {
	console.log(row);
	var html = [];
	return html.join('')
	
}
</script>
