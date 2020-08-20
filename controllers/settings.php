<?php

class SettingsController extends PluginController
{
    public function video_action()
    {
        if (!Context::get()->id || !$GLOBALS['perm']->have_studip_perm("tutor", Context::get()->id)) {
            throw new AccessDeniedException();
        }
        Navigation::activateItem("/course/admin/videopreview");
    }

    public function savevideo_action()
    {
        if (!Context::get()->id || !$GLOBALS['perm']->have_studip_perm("tutor", Context::get()->id)) {
            throw new AccessDeniedException();
        }
        if (Request::isPost()) {
            if (Request::submitted("delete")) {
                CourseConfig::get(Context::get()->id)->delete("VIDEOPREVIEW_TITLE");
                CourseConfig::get(Context::get()->id)->delete("VIDEOPREVIEW_URL");
                PageLayout::postSuccess(dgettext("videopreview", "Das Vorschauvideo wurde gelöscht."));
            } else {
                CourseConfig::get(Context::get()->id)->store("VIDEOPREVIEW_TITLE", Request::get("title"));
                CourseConfig::get(Context::get()->id)->store("VIDEOPREVIEW_URL", Request::get("url"));
                PageLayout::postSuccess(dgettext("videopreview", "Daten des Videos wurden gespeichert."));
            }
        }
        $this->redirect("settings/video");
    }
}
