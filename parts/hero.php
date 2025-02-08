<section class="hero-section py-5">
    <div class="container">
        <div class="row align-items-center">
            <?php
            // Obtener el último sorteo publicado
            $args = array(
                'post_type' => 'sorteos',
                'posts_per_page' => 1, // Solo el más reciente
                'orderby' => 'date',
                'order' => 'DESC',
            );
            $sorteo_query = new WP_Query($args);

            if ($sorteo_query->have_posts()) :
                while ($sorteo_query->have_posts()) : $sorteo_query->the_post();
            ?>
            <!-- Columna izquierda: Información del sorteo -->
            <div class="col-md-6">
                <h1 class="display-4 h1_class"><?php the_title(); ?></h1>
                <div class="sorteo-content">
                    <?php the_excerpt(); // Resumen del sorteo ?>
                </div>
                <a href="<?php the_permalink(); ?>" class="btn btn-primary quiero-un-numero mt-3">Quiero un número</a>
            </div>

            <!-- Columna derecha: Imagen destacada -->
            <div class="col-md-6 text-center">
            <?php
				$image = get_field('imagen_rifa');
				if( !empty($image) ): ?>
				    <img class="mx-auto d-block img-hero" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
				<?php endif; ?>
            </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
            ?>
            <div class="col-12 text-center">
                <p>No hay sorteos disponibles en este momento.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
