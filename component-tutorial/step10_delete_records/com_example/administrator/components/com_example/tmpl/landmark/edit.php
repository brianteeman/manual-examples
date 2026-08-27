<?php
defined('_JEXEC') or die;

use Joomla\CMS\Router\Route;
use Joomla\CMS\HTML\HTMLHelper;
?>

<form action="<?php echo Route::_('index.php?option=com_example&layout=edit&id=' . (int) $this->item->id); ?>"
    method="post" name="adminForm" id="adminForm">

    <?php echo $this->form->renderField('title');  ?>

    <?php echo $this->form->renderField('description');  ?>

    <?php echo $this->form->renderField('id');  ?>

    <input type="hidden" name="task" value="" />
    <?php echo HTMLHelper::_('form.token'); ?>
</form>