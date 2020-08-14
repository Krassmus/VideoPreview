<?php

class VideoPreview extends StudIPPlugin implements SystemPlugin, DetailspagePlugin
{
    public function __construct()
    {
        parent::__construct();

        if (Navigation::hasItem("/course")
                && Context::get()->id
                && Context::isCourse()
                && $GLOBALS['perm']->have_studip_perm("tutor", Context::get()->id)) {
            $nav = new Navigation(_("Vorschauvideo"), PluginEngine::getURL($this, [], "settings/video"));
            $nav->setDescription(_("Ein optionales Video, das unangemeldeten Nutzenden angezeigt wird, wenn sie sich die Detailseite dieser Veranstaltung in der Suche anschauen."));
            $nav->setImage(Icon::create("video", "navigation"));
            Navigation::addItem("/course/admin/videopreview", $nav);
        }
    }

    public function getDetailspageTemplate($course)
    {
        if (!CourseConfig::get($course->id)->VIDEOPREVIEW_URL) {
            return null;
        }
        PageLayout::addStylesheet($this->getPluginURL()."/assets/videopreview.css");
        $tf = new Flexi_TemplateFactory(__DIR__."/views");
        $template = $tf->open("widget/video");
        $template->url = CourseConfig::get($course->id)->VIDEOPREVIEW_URL;
        $template->title = CourseConfig::get(Context::get()->id)->VIDEOPREVIEW_TITLE ?: _("Blick in den Kurs");
        return $template;
    }
}
