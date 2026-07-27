<?php

\defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

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
                        <?php 
                            $url = Route::_('index.php?option=com_example&task=landmark.edit&id=' . $item->id);
                            $linkText = $this->escape($item->title); 
                            echo "<a href='{$url}'>{$linkText}</a>";
                        ?>
                    </th>
                    <td>
                        <?php echo (int) $item->id; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
    </tbody>
</table>
