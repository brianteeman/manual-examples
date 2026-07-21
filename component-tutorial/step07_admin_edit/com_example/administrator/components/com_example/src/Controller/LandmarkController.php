<?php

namespace My\Component\Example\Administrator\Controller;

\defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;

class LandmarkController extends BaseController {

    public function edit() 
    {
        $id = $this->input->get('id', 0, "INT");
        $this->setRedirect(Route::_("index.php?option=com_example&view=landmark&layout=edit&id={$id}", false));
        return true;
    }
    
    public function cancel() 
    {
        $this->checkToken();

        $this->app->setUserState('com_example.edit.landmark.data', null);

        $this->setRedirect(Route::_("index.php?option=com_example&view=landmarks", false));

        return true;
    }
    
    public function save($key = null, $urlVar = null)
    {
        $this->checkToken();

        $model   = $this->getModel();
        $table   = $model->getTable();
        
        // get the submitted data which was sent in the HTTP POST 
        // It's in an array called jform - because of 'control' => 'jform' in the previous loadForm call
        $data    = $this->input->post->get('jform', [], 'array');
        $id = (int)$data['id'];
        
        // the filtering and validation is based on information in the form
        // so to do that we need to load the form again
        $form = $model->getForm();
        
        // perform filtering on the data to remove risky HTML tags
        // This will result in a $form->filter($data) call in the Model
        $data = $model->filter($form, $data);
        
        // perform validation on the data
        // This will result in a $form->validate($data) call in the Model
        $result = $model->validate($form, $data);
        if (!$result) {
            $this->app->setUserState('com_example.edit.landmark.data', $data);

            $this->setMessage(Text::sprintf('JLIB_APPLICATION_ERROR_SAVE_FAILED', $model->getError()), 'error');
            
            // Redirect back to the edit screen.
            $this->setRedirect(Route::_("index.php?option=com_example&view=landmark&layout=edit&id={$id}", false));

            return false;
        }

        // Attempt to save the data.
        if (!$model->save($data)) {
            $this->app->setUserState('com_example.edit.landmark.data', $data);

            $this->setMessage(Text::sprintf('JLIB_APPLICATION_ERROR_SAVE_FAILED', $model->getError()), 'error');

            $this->setRedirect(Route::_("index.php?option=com_example&view=landmark&layout=edit&id={$id}", false));

            return false;
        }

        // clear the session data
        $this->app->setUserState('com_example.edit.landmark.data', null);
        
        // This sets a message within the system message area on the administrator page
        $this->setMessage(Text::_('COM_EXAMPLE_SAVE_SUCCESS'));

        // Redirect back to the list of landmarks
        $this->setRedirect(Route::_("index.php?option=com_example&view=landmarks", false));

        return true;
    }
    
    public function apply($key = null, $urlVar = null)
    {
        $this->checkToken();

        $model = $this->getModel();
        $table = $model->getTable();
        $data = $this->input->post->get('jform', [], 'array');
        $id = (int)$data['id'];
 
        $form = $model->getForm();
        
        // perform filtering on the data
        $data = $model->filter($form, $data);
        $this->app->setUserState('com_example.edit.landmark.data', $data);
        
        // perform validation on the data
        $result = $model->validate($form, $data);
        if (!$result) {

            $this->setMessage(Text::sprintf('JLIB_APPLICATION_ERROR_SAVE_FAILED', $model->getError()), 'error');
            
            // Redirect back to the edit screen.
            $this->setRedirect(Route::_("index.php?option=com_example&view=landmark&layout=edit&id={$id}", false));

            return false;
        }

        // Attempt to save the data.
        if (!$model->save($data)) {

            $this->setMessage(Text::sprintf('JLIB_APPLICATION_ERROR_SAVE_FAILED', $model->getError()), 'error');

            $this->setRedirect(Route::_("index.php?option=com_example&view=landmark&layout=edit&id={$id}", false));

            return false;
        }
        
        $this->app->setUserState('com_example.edit.landmark.data', null);
        
        $this->setMessage(Text::_('COM_EXAMPLE_SAVE_SUCCESS'));

        $this->setRedirect(Route::_("index.php?option=com_example&view=landmark&layout=edit&id={$id}", false));

        return true;
    }
}