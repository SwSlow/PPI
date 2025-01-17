<?php
session_start();
include('./db/config.php');
include('./auth/protect.php');

$id = $_SESSION['userID'];

?>
<!DOCTYPE html>
<html>

<script>
  function sairAlert() {
    alert("Deslogado com sucesso!")
  }

  function controlPanel() {
    location.href = "./controlPanel.php";
  }
</script>

<head>
  <link rel="stylesheet" href="css/stylePrincipal.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

  <!-- swiper link -->

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />


</head>
<meta charset="utf-8">

<title>| Bem-Vindo!</title>

<body>
  <header class="nav-down">
    <img class="logoBib" src="imagens/Logo.png">

    <div class="dropDownIMG">

      <img class="UserBib" src="imagens/User.png">

      <?php
      if ($_SESSION['permissionLevel'] == 'admin') {

        $dropMenu = "
        <div class=\"dropdownContent\">
        <a href = \"./controlPanel.php\">Painel de Controle</a>
        <a href = \"./auth/logout.php\" onclick=\"sairAlert()\">LogOff</a>
        </div>";
      } else {
        $dropMenu = "
        <div class=\"dropdownContent\">
        <a href=\"./user/?user=$id\">Perfil</a>
        <a href = \"./auth/logout.php\" onclick=\"sairAlert()\">LogOff</a>
        </div>";
      }

      echo ($dropMenu)
      ?>

    </div>
    <div class="search-box">
      <input class="search-txt" type="text" name="" placeholder="Digite sua pesquisa">
      <a class="search-btn" href="#">
        <i class="fas fa-search"></i>
      </a>
    </div>

    <div class="dropdown">
      <button class="dropbtn">Categorias</button>
      <div class="dropdown-content">
        <a href="#ebooksLink">Ebooks</a>
        <a href="#educacionaisLink">Educacionais</a>
        <a href="#romanceLink">Romance</a>
        <a href="#aventuraLink">Aventura</a>
        <a href="#suspenseLink">Suspense</a>
        <a href="#terrorLink">Terror</a>
        <a href="#biografiaLink">Biografia</a>
        <a href="#contosLink">Contos</a>
      </div>
    </div>

    </div>
  </header>

  <br><br><br><br>

  <h4 class="swiper-title">Acervo</h4>

  <div class="form">

    <section class="swiper-container">

      <div class="swiper mySwiper">
        <div class="swiper-wrapper">

          <?php
          include('./db/config.php');

          $sqlCode = "SELECT * FROM item ORDER BY itemID DESC LIMIT 18";
          $sql_query = $mysqli->query($sqlCode) or die("Falha na execução do código SQL: " . $mysqli);

          while ($item = $sql_query->fetch_assoc()) {
            $id = $item["itemID"];
            $cover = $item["cover"];
            $title = $item["title"];

            $itemArticle = "
            <div class=\"swiper-slide\">
            <a href=\"./item/?item=$id\" class=\"\"><img src=\"$cover\" alt=\"Capa:$title\"></a>
            <h6>$title</h6>
            </div>";

            echo ($itemArticle);
          };
          ?>

        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
      </div>
    </section>
    <br><br><br><br><br><br>

    <!-- slide -->

    <?php
    include('./db/config.php');

    $sqlCodeTag = "SELECT * FROM itemtag 
    INNER JOIN tag ON tag.tagID = itemtag.tagID
    INNER JOIN item ON item.itemID = itemtag.itemID";
    $sql_query_tag = $mysqli->query($sqlCodeTag) or die("Falha na execução do código SQL: " . $mysqli);

    while ($item = $sql_query->fetch_assoc()) {
      $idTag = $item["tagID"];
      $tagName = $item["name"];

      $sqlCode = "SELECT * FROM item
      INNER JOIN itemTag ON item.itemID = itemTag.itemID
      INNER JOIN tag ON itemTag.tagID = tag.tagID WHERE tag.name='$tagName'";
      $sql_query = $mysqli->query($sqlCode) or die("Falha na execução do código SQL: " . $mysqli);

      while ($item = $sql_query->fetch_assoc()) {
        $id = $item["itemID"];
        $cover = $item["cover"];
        $title = $item["title"];

        $book = "
            <div class=\"swiper-slide\">
            <a href=\"./item/?item=$id\" class=\"\"><img src=\"$cover\" alt=\"Capa:$title\"></a>
            <h6>$title</h6>
            </div>";

        $itemArticle = "
      <h4 class=\"swiper-title\">$tagName</h4>
      <div class=\"form\">

      <section class=\"swiper-container\">

        <div class=\"swiper mySwiper\">
          <div class=\"swiper-wrapper\">

          $book

          </div>

        <div class=\"swiper-button-next\"></div>
        <div class=\"swiper-button-prev\"></div>

        </div>
        </section>
        <br><br><br><br><br><br>";

        echo ($itemArticle);
      }
    }
    ?>

    <!-- cabeçalho interativo -->

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

    <script>
      var didScroll;
      var lastScrollTop = 0;
      var delta = 5;
      var navbarHeight = $('header').outerHeight();

      $(window).scroll(function(event) {
        didScroll = true;
      });

      setInterval(function() {
        if (didScroll) {
          hasScrolled();
          didScroll = false;
        }
      }, 250);

      function hasScrolled() {
        var st = $(this).scrollTop();

        if (Math.abs(lastScrollTop - st) <= delta)
          return;


        if (st > lastScrollTop && st > navbarHeight) {
          $('header').removeClass('nav-down').addClass('nav-up');
        } else {
          if (st + $(window).height() < $(document).height()) {
            $('header').removeClass('nav-up').addClass('nav-down');
          }
        }

        lastScrollTop = st;
      }
    </script>

    <!-- swiper script -->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

    <script>
      var swiper = new Swiper(".mySwiper", {

        slidesPerView: 6,
        autoResize: false,
        spaceBetween: 70,
        centeredSlides: true,
        loop: true,
        setWrapperSize: true,
        followFinger: true,
        setWrapperSize: true,
        slidesPerGroup: 3,
        speed: 800,

        keyboard: {
          enabled: true,
          onlyInViewport: true,
        },

        breakpoints: {
          320: {
            slidesPerView: 2,
            spaceBetween: 15
          },
          600: {
            slidesPerView: 3,
            spaceBetween: 25
          },
          900: {
            slidesPerView: 4,
            spaceBetween: 35
          },

          1300: {
            slidesPerView: 6,
            spaceBetween: 65
          },

          1500: {
            slidesPerView: 6,
            spaceBetween: 65
          },

          1800: {
            slidesPerView: 6,
            spaceBetween: 70
          },


        },
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',

        },

      });
    </script>

    <?php
    //Recuperando o valor da variável global, os erro de login.
    if (isset($_SESSION['loginErro'])) {
      echo $_SESSION['loginErro'];
      unset($_SESSION['loginErro']);
    } ?>

    <?php
    //Recuperando o valor da variável global, deslogado com sucesso.
    if (isset($_SESSION['logindeslogado'])) {
      unset($_SESSION['logindeslogado']);
    }
    ?>



</body>


<footer>
  <img class="fundos" src="imagens/ondaas.PNG">
</footer>


</html>