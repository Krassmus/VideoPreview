<?php

class VideoPreview extends StudIPPlugin implements SystemPlugin, DetailspagePlugin
{
    public function __construct()
    {
        bindtextdomain("videopreview", __DIR__."/locale");
        parent::__construct();
        PageLayout::addStylesheet($this->getPluginURL()."/assets/videopreview.css");
        if (Navigation::hasItem("/course")
                && Context::get()->id
                && Context::isCourse()
                && $GLOBALS['perm']->have_studip_perm("tutor", Context::get()->id)) {
            $nav = new Navigation(dgettext("videopreview", "Vorschauvideo"), PluginEngine::getURL($this, [], "settings/video"));
            $nav->setDescription(dgettext("videopreview", "Ein optionales Video, das unangemeldeten Nutzenden angezeigt wird, wenn sie sich die Detailseite dieser Veranstaltung in der Suche anschauen."));
            $nav->setImage(Icon::create("video", "navigation"));
            Navigation::addItem("/course/admin/videopreview", $nav);
        }
    }

    public function getDetailspageTemplate($course)
    {
        if (!CourseConfig::get($course->id)->VIDEOPREVIEW_URL) {
            return null;
        }
        $tf = new Flexi_TemplateFactory(__DIR__."/views");
        $template = $tf->open("widget/video");
        $template->url = CourseConfig::get($course->id)->VIDEOPREVIEW_URL;
        $template->title = CourseConfig::get(Context::get()->id)->VIDEOPREVIEW_TITLE ?: dgettext("videopreview", "Blick in den Kurs");
        return $template;
    }
}
