<?php defined('RUNNING') or die("Access violation"); ?>
<!DOCTYPE html>
<html lang="pl">

<?php include TEMPLATE_DIR.'head.html.php' ?>

<body>
    <span id="top"></span>
    <div class="wrapper">
        <header>

            <div class="logo">
                Galeria zdjęć
            </div>


        </header>
        <nav>
            <input id="switch" type="checkbox" />
            <label for="switch">&#9776;</label>
            <div class="menu">
                <ul>
                    <li>
                        <a href="/">Strona główna</a>
                    </li>
                    <li>
                        <a href="/gallery/index">Wszystkie zdjęcia</a>
                        <!--<ul>
                            <li>
                                <a href="polishFilms.html">Polskie</a>
                            </li>
                            <li>
                                <a href="foreignFilms.html">Zagraniczne</a>
                            </li>
                        </ul>-->
                    </li>
                    <li>
                        <a href="/gallery/indexsavedpictures">Zapisane zdjęcia</a>
                    </li>
                    <li>
                        <a href="/gallery/add">Dodaj zdjęcie</a>

                    </li>

                </ul>
            </div>

        </nav>
        <div class="container">
    
            
            <?php foreach ($_SESSION['messages'] as $message): ?>
                      
                          <div class="message block <?php echo $message->type; ?>">
                          <?php echo $message->message; ?>
                           </div>
                      
            <?php endforeach; ?>
           
  
            <div class="col1 block">
                <div class="title">
                    <?php safePrint($output['col1']['title']) ?>
                </div>
                <div id="col1-content" class="text">
                    <?php include TEMPLATE_DIR.'col1.html.php'; ?>
                </div>
            </div>
            <div class="content block">
                <div class="title">
                    <?php echo $output['content']['title']; ?>
                </div>
                <div class="text">
                    <?php include $output['content']['content']; ?>
                </div>
            </div>
            <div class="col2 block">
                <div class="title">
                    <?php safePrint($output['col2']['title']); ?>
                </div>
                <div class="text">
                    <?php include $output['col2']['content'] ;?>
                </div>
            </div>

        </div>
    </div>
    <footer>
        <div class="footer-left">
            <a class="footer-a" href="#top">&uarr;</a>
            <!--<a class="footer-a color-red" onclick="setColorCSS('red')" href="#">R</a>
            <a class="footer-a color-green" onclick="setColorCSS('default')" href="#">G</a>
            <a class="footer-a color-blue" onclick="setColorCSS('blue')" href="#">B</a>-->


        </div>
        <div class="footer-center">
            &copy; 2016 Kamil Królikowski


        </div>
        <div class="footer-right">
            <a class="footer-a" href="mailto:kamil-krolikowski@outlook.com">&#9993;</a>
        </div>

    </footer>
</body>
</html>
