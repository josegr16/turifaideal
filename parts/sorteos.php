<section id="rifas" class="pt-5 pb-5">
    <div class="container">
        <h3 class="mb-4 mt-5 elige_rifas">¡Vamos! Elige una rifa y empieza a jugar</h3>
        <p class="elige_rifas_parrafo p-0 pb-5">Elige tu próxima rifa favorita en tu rifa ideal Derwin.</p>
        <div id="carouselExampleCaptions" class="carousel carousel-dark slide" data-bs-ride="carousel" data-bs-interval="5000">
            <!-- Indicadores -->
            <div class="carousel-indicators">
                <?php
                $sorteos_query = new WP_Query(array(
                    'post_type' => 'sorteos',
                    'posts_per_page' => -1,
                ));
                $total_posts = $sorteos_query->post_count;
                $slides = ceil($total_posts / 3); // Mostrar 3 tarjetas por slide
                for ($i = 0; $i < $slides; $i++) :
                ?>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo $i; ?>" class="<?php echo $i === 0 ? 'active' : ''; ?>" aria-label="Slide <?php echo $i + 1; ?>"></button>
                <?php endfor; ?>
            </div>

            <!-- Contenido del Carrusel -->
            <div class="carousel-inner">
                <?php
                if ($sorteos_query->have_posts()) :
                    $counter = 0;
                    while ($sorteos_query->have_posts()) : $sorteos_query->the_post();
                        // Abrir un nuevo slide cada 3 tarjetas
                        if ($counter % 3 === 0) :
                ?>
                        <div class="carousel-item <?php echo $counter === 0 ? 'active' : ''; ?>">
                            <div class="card-group">
                <?php endif; ?>

                                <!-- Tarjeta -->
                                <div class="card me-5">
                                <?php
                                    $image = get_field('imagen_rifa');
                                    if( !empty($image) ): ?>
                                        <img class="mx-auto d-block img-hero" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                                    <?php endif; ?>
                                    <div class="card-body">
                                        <h5 class="card-title"><?php the_title(); ?></h5>
                                        <p class="card-text"><?php echo wp_trim_words(get_the_content(), 15, '...'); ?></p>
                                        <a href="<?php the_permalink(); ?>" class="btn btn-primary btn_quierojugar">Quiero jugar</a>
                                    </div>
                                </div>

                <?php
                        $counter++;
                        // Cerrar el slide después de 3 tarjetas o al final del loop
                        if ($counter % 3 === 0 || $counter === $total_posts) :
                ?>
                            </div>
                        </div>
                <?php
                        endif;
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                    <p class="text-center">No hay rifas disponibles en este momento.</p>
                <?php endif; ?>
            </div>

            <!-- Controles -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
    </div>
</section>
