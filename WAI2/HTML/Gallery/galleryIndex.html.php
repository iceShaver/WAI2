<?php defined('RUNNING') or die("Access violation"); ?>

<div class="gallery">
    <form action="/gallery/<?php safePrint($output['picturesAction']); ?>" method="post">
        <?php foreach ((array)$output['pictures'] as $picture): ?>


        <div class="picture">
            <input class="selectPicture" type="checkbox" name="savedPictures[]" id="<?php safePrint($picture['_id']); ?>" value="<?php safePrint($picture['_id']); ?>" />

            <label for="<?php safePrint($picture['_id']); ?>">
                <a href="/gallery/showpicture/<?php safePrint($picture['_id']) ?>">
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
        <!--<input type="hidden" name="action" value="" />-->
        <input type="submit" value="<?php safePrint($output['picturesActionButton']); ?>" />
    </form>
</div>