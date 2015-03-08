<?php get_header(); ?>

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
  <div class="container">
    <h1><?php the_title(); ?></h1>

    <!-- TODO: Add in a "page description" section here? -->
    <!-- <p class="lead">Our mission is simple: We innovate, learn, and build community at the intersection of art, technology, science, and culture.</p> -->

  </div>
</div>

<div class="container">
  <!-- Example row of columns -->
  <div class="row">
    <div class="col-md-12">
      
      <!-- THE LOOOOOOOOOOOP -->
      <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>

        <?php the_content(); ?>

      <?php endwhile; ?>
      <?php endif; ?>

    </div>
  </div>
</div>

<?php get_footer(); ?>
