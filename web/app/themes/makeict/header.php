<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">

    <?php if (is_home()) { ?>
      <title><?php echo get_bloginfo('name'); ?></title>
    <?php } else { ?>
      <title><?php echo get_bloginfo('name'); ?><?php wp_title('|'); ?></title>
    <?php } ?>


    <!-- Bootstrap core CSS -->
    <link href="<?php echo get_template_directory_uri(); ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo get_template_directory_uri(); ?>/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><?php echo bloginfo('name'); ?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse pull-right">
          <ul class="nav navbar-nav">
            <li><a href="/events" title="MakeICT Events">Events</a></li>
            <li><a href="/projects" title="MakeICT Projects">Projects</a></li>
            <li><a href="/makerspace" title="MakeICT MakerSpace">MakerSpace</a></li>
            <li><a href="/get-involved" title="Get Involved with MakeICT">Get Involved</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Community <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#" title="MakeICT Forum">Forum</a></li>
                <li><a href="#" title="MakeICT Wiki">Wiki</a></li>
                <li><a href="/blog" title="MakeICT Blog">Blog</a></li>
              </ul>
            </li>
            <li><a href="/contact-us" title="Contact MakeICT">Contact Us</a></li>
          </ul>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>
