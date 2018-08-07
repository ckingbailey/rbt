<?php
  $base = $_SERVER['DOCUMENT_ROOT'] . '/..';
  require "$base/vendor/autoload.php";
  require "$base/config.php";
  require "$base/inc/session.php";

  // instantiate Twig
  $loader = new Twig_Loader_Filesystem("$base/templates");
  $twig = new Twig_Environment($loader,
      [
          'debug' => true
      ]
  );
  $twig->addExtension(new Twig_Extension_Debug());
  
  $template = $twig->load('constructionPlaceholder.html.twig');
  $context = [
    'title' => 'Under Construction - Please check back soon',
    'navbarHeading' => '',
    'navItems' => [],
    'pageHeading' => '🚧 Under Construction 🚧',
    'subHeading' => 'Please check back soon',
    'titleImg' => [
      'src' => '/assets/img/574px-Railway,_construction,_men,_barrel_Fortepan_17998.jpg',
      'alt' => 'Railway under construction'
    ],
    'textColor' => 'text-yellow'
  ];
  
  $template->display($context);
