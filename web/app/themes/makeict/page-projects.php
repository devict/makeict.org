<?php get_header(); ?>

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
  <div class="container">
    <h1>Projects</h1>
    <p class="lead">These are some of the projects that MakeICT and it's members have worked on.</p>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <?php
        $args = array( 'post_type' => 'project', 'posts_per_page' => 10 );
        $loop = new WP_Query( $args );
      ?>
      <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
        <h3><a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a></h3>
      <?php endwhile; ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>
