<?php
namespace My\Component\Example\Administrator\Model;
 
\defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ItemModel;
use Joomla\CMS\Factory;
use Joomla\CMS\Form\FormFactoryAwareInterface;
use Joomla\CMS\Form\FormFactoryAwareTrait;
use Joomla\CMS\MVC\Model\FormModelInterface;
use Joomla\CMS\MVC\Model\FormBehaviorTrait;

class LandmarkModel extends ItemModel implements FormFactoryAwareInterface, FormModelInterface
{
    use FormFactoryAwareTrait;  // getter/setter for FormFactory, which instantiates the Form object
    use FormBehaviorTrait;      // contains the functions for loadForm etc
    
    function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm(
            'com_example.landmark', // a name you assign to the form - include com_example to make it unique
            'landmark',             // the xml filename - Joomla will find it in forms/landmark.xml
            array(
                'control' => 'jform',       // the name of the parameter in the HTTP POST
                'load_data' => $loadData    // whether to prefill data or not
            )
        );

        if (empty($form))
        {
            return false;
        }

        return $form;
    }
    
    protected function loadFormData()  // the callback function which is called if $loadData was true
    {
        // Check the session for previously entered form data.
        $data = Factory::getApplication()->getUserState('com_example.edit.landmark.data', array());

        if (empty($data))
        {
            $data = $this->getItem();
        }

        return $data;
    }
    
    function getItem($pk = null) // gets the landmark record from the database, based on the HTTP id parameter
    {
        $app = Factory::getApplication();
        $input = $app->getInput();
        $id = $input->get('id', 0, 'INT');

        $table = $this->getTable('Landmark', 'Administrator');
        $result = $table->load($id);
        if ($result) {
            return $table;
        } else {
            throw new \UnexpectedValueException("id out of range");
        }
    }
    
    function filter($form, $data)
    {
        return $form->filter($data);
    }
    
    function validate($form, $data)
    {
        $result = $form->validate($data);
        
        // Check for errors
        // Joomla has been moving from custom errors attached to objects to the use of PHP Exceptions,
        // so in this transitional phase you have to check for both
        if ($result instanceof \Exception) {
            $this->setError($result->getMessage());
            return false;
        }

        if ($result === false) {
            // Get the validation messages from the form.
            foreach ($form->getErrors() as $message) {
                $this->setError($message);
            }
            return false;
        }
        
        return true;
    }
        
    function save($data)
    {
        $table = $this->getTable();
        $result = $table->load($data['id']);
        if (!$result) {
            throw new \UnexpectedValueException("id out of range");
        }
        
        if (!$table->bind($data)) {
            $this->setError($table->getError());
            return false;
        }
        
        if (!$table->store()) {
            $this->setError($table->getError());
            return false;
        }
        
        return true;
    }
}