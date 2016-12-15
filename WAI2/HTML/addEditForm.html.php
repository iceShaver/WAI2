
<form>
    <fieldset>
        <legend>
            <?php safePrint($output->formLegend); ?>
        </legend>
        <input type="hidden" name="id" value=" <?php safePrint($output->id); ?>" />
        <label for="title">Nazwa zdjęcia</label>
        <input type="text" id="title" name="title" value=" <?php safePrint($output->title); ?>" />
        <br/>
        <label for="author">Autor zdjęcia</label>
        <input type="text" id="author" name="author" value=" <?php safePrint($output->author); ?> " />
        <br />
        <label for="author">Znak wodny (obowiązkowe)</label>
        <input type="text" id="watermark" name="watermark" value=" <?php safePrint($output->watermark); ?>" />
        <br />
        Czy zdjęcie ma być prywatne?
<br />
        <input type="radio" name="private" id="true" value="true" <?php echo ($output->private&&$output->private!=null) ? 'checked="checked"' : null ?>/>
        <label for="true">Tak</label>
        <input type="radio" name="private" id="false" value="false" <?php echo (!$output->private&&$output->private!=null) ? 'checked="checked"' : null ?>/>
        <label for="false">Nie</label>
                                                                 
    </fieldset>
</form>