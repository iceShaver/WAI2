<span id="top"></span>
<div class="wrapper">
    <header>

        <div class="logo">
            Filmy
        </div>


    </header>

    <div class="container">


        <div class="col1 block">
            <div class="title"><?php safePrint($output->col1Title) ?></div>
            <div id="col1-content" class="text">
                ąęźćół
                <?php safePrint($output->col1Content) ?>
            </div>
        </div>
        <div class="content block">
            <div class="title"><?php safePrint($output->contentTitle) ?></div>
            <div class="text">
                <?php echo $output->content ?>
            </div>
        </div>
        <div class="col2 block">
            <div class="title"><?php safePrint($output->col2Title) ?></div>
            <div class="text">
               <?php safePrint($output->col2Content) ?>
            </div>
        </div>

    </div>
</div>