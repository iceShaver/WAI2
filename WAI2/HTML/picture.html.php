<div class="picture-full">
    <img src="<?php safePrint(PHOTOS_DIR_RELATIVE.$output['picture']['wmId'].'.'.$output['picture']['extension']); ?>" alt="<?php safePrint($output['picture']['title']); ?>" />
    <div class="picture-full-info">
        Tytuł:          <?php safePrint($output['picture']['title']); ?><br/>
        Autor:          <?php safePrint($output['picture']['author']); ?><br/>
        Czas wysłania:  <?php safePrint(date('Y-m-d H:i:s', $output['picture']['creationTime'])); ?><br/>
        Opis:           <?php safePrint($output['picture']['description']); ?>
    </div>
</div>