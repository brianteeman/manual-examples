<?php

\defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

?>
<table class="table">
    <caption class="visually-hidden">
        <?php echo Text::_('COM_EXAMPLE_LANDMARKS_CAPTION'); ?>
    </caption>
    <thead>
        <tr>
            <th scope="col">
                <?php echo Text::_('JGLOBAL_TITLE'); ?>
            </th>
            <th scope="col">
                <?php echo Text::_('JGRID_HEADING_ID'); ?>
            </th>
        </tr>
    </thead>
    <tbody><?php foreach ($this->items as $i => $item) :?>
                <tr>
                    <th scope="row">
                        <?php echo $item->title; ?>
                    </th>
                    <td>
                        <?php echo $item->id; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
    </tbody>
</table>
