
<div class="gallery">
    <form action="?module=gallery" method="post">
        <?php foreach ($output['pictures'] as $picture): ?>
        

            <div class="picture">
                <input class="selectPicture" type="checkbox" name="savedPictures[]" id="<?php safePrint($picture['_id']); ?>" value="<?php safePrint($picture['_id']); ?>" />

                <label for="<?php safePrint($picture['_id']); ?>">
                    <a href="?module=gallery&action=showpicture&id=<?php safePrint($picture['_id']) ?>">
                        <img alt="<?php safePrint($picture['title']) ?>" src="<?php safePrint(PHOTOS_DIR_RELATIVE.$picture['minId'].'.'.$picture['extension']); ?>" />
                    </a>
</label>
                <div class="picture-info">
                    Tytuł: <?php safePrint($picture['title']) ?>
                    <br />
                    Autor: <?php safePrint($picture['author']) ?>
                    <br />
                    <?php echo ($picture['private']) ? '<span class="private">prywatne</span>' : null; ?>
                </div>

            </div>


       

        <?php endforeach; ?>
        <input type="hidden" name="action" value="<?php safePrint($output['picturesAction']); ?>" />
        <input type="submit" value="<?php safePrint($output['picturesActionButton']); ?>" />
    </form>
</div>