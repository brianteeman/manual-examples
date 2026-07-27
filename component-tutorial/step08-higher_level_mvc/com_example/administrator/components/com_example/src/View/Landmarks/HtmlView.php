<?php

namespace My\Component\Example\Administrator\View\Landmarks;

\defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

class HtmlView extends BaseHtmlView {

    function display($tpl = null) {

        $model = $this->getModel();
        $this->items = $model->getItems();

        parent::display($tpl);
    }
}