<div class="gallery">
    <?php foreach ($output['pictures'] as $picture): ?>
    <a href="?module=gallery&action=showpicture&id=<?php safePrint($picture['_id']) ?>">
        <img class="picture" alt="<?php safePrint($picture['title']) ?>" src="<?php safePrint(PHOTOS_DIR_RELATIVE.$picture['fileName']); ?>" /></a>
    <?php endforeach; ?>


</div>