<?php get_header(); ?>

<!-- THE LOOOOOOOOOOOP -->
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

  <?php $custom_fields = get_post_custom(get_the_ID()); ?>

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron feature">
    <div class="container">
      <?php the_content(); ?>
    </div>
  </div>

  <div class="container">
    <!-- Example row of columns -->
    <div class="row">
      <div class="col-md-4">
        <h2><?php echo $custom_fields['Column 1 Header'][0]; ?></h2>
        <?php echo $custom_fields['Column 1 Body'][0]; ?>
      </div>
      <div class="col-md-4">
        <h2><?php echo $custom_fields['Column 2 Header'][0]; ?></h2>
        <?php echo $custom_fields['Column 2 Body'][0]; ?>
       </div>
      <div class="col-md-4">
        <h2><?php echo $custom_fields['Column 3 Header'][0]; ?></h2>
        <?php echo $custom_fields['Column 3 Body'][0]; ?>
      </div>
    </div>
  </div>

<?php endwhile; ?>
<?php endif; ?>


<?php get_footer(); ?>
