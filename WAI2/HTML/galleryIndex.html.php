<div class="gallery">
    <?php foreach ($output['pictures'] as $picture): ?>
    <a href="?module=gallery&action=showpicture&id=<?php safePrint($picture['_id']) ?>">
        <div class="picture">
            <img alt="<?php safePrint($picture['title']) ?>" src="<?php safePrint(PHOTOS_DIR_RELATIVE.$picture['minId'].'.'.$picture['extension']); ?>" />
            <div class="picture-info">
                Tytuł: <?php safePrint($picture['title']) ?><br/>
                Autor: <?php safePrint($picture['author']) ?><br/>
            </div>
        </div>
    </a>

    <?php endforeach; ?>


</div>