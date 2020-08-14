<form class="default" method="post" action="<?= PluginEngine::getLink($plugin, [], "settings/savevideo") ?>">
    <fieldset>
        <legend><?= _("Angaben zum Vorschauvideo") ?></legend>
        <label>
            <?= _("Titel des Videos") ?>
            <input type="text" name="title" value="<?= htmlReady(CourseConfig::get(Context::get()->id)->VIDEOPREVIEW_TITLE) ?>" placeholder="Blick in den Kurs">
        </label>
        <label>
            <?= _("URL des Videos") ?>
            <input type="text" name="url" value="<?= htmlReady(CourseConfig::get(Context::get()->id)->VIDEOPREVIEW_URL) ?>" placeholder="https://...">
        </label>
        <div data-dialog-button>
            <?= \Studip\Button::create(_("Speichern")) ?>
            <? if (CourseConfig::get(Context::get()->id)->VIDEOPREVIEW_URL) : ?>
            <?= \Studip\Button::create(_("Löschen"), "delete") ?>
            <? endif ?>
        </div>
    </fieldset>

</form>
