<?php

\defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

?>
<table class="table">
    <thead>
        <tr>
            <th>
                <?php echo Text::_('JGLOBAL_TITLE'); ?>
            </th>
            <th>
                <?php echo Text::_('JGRID_HEADING_ID'); ?>
            </th>
        </tr>
    </thead>
    <tbody><?php foreach ($this->items as $i => $item) :?>
                <tr>
                    <td>
                        <?php echo $item->title; ?>
                    </td>
                    <td>
                        <?php echo $item->id; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
    </tbody>
</table>
