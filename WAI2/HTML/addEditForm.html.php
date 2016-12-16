
<form enctype="multipart/form-data" action="?module=gallery&action=insert" method="POST">
    <fieldset>
        <legend>
            <?php safePrint($output->formLegend); ?>
        </legend>

        <input type="hidden" name="_id" value="<?php safePrint($output->_id); ?>" />
        <label for="title">Nazwa zdjęcia</label>
        <input type="text" id="title" name="title" value="<?php safePrint($output->title); ?>" />
        <br />
        <label for="author">Autor zdjęcia</label>
        <input type="text" id="author" name="author" value="<?php safePrint($output->author); ?>" />
        <br />
        <label for="author">Znak wodny (obowiązkowe)</label>
        <input type="text" id="watermark" name="watermark" value="<?php safePrint($output->watermark); ?>" /><br/>
        <label for="description">Opis zdjęcia</label><br/>
        <textarea id="description" name="description"><?php safePrint($output->description)?></textarea><br/>
        <br />
        Czy zdjęcie ma być prywatne?
        <br />
        <input type="radio" name="private" id="true" value="true" 
        <?php echo ($output->private&&$output->private!=null) ? 'checked="checked"' : null ?> />
        <label for="true">Tak</label>
        <input type="radio" name="private" id="false" value="false" 
        <?php echo (!$output->private&&$output->private!=null) ? 'checked="checked"' : null ?> />
        <label for="false">Nie</label><br/>
        <input type="file" name="photo" /><br/>
        <input type="submit" value="Wyślij" />
    </fieldset>
</form>