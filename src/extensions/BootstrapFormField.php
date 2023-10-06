<?php
/**
 * Extention of FormField
 */
namespace Axllent\BootstrapForms;

use SilverStripe\Control\Controller;
use SilverStripe\Core\Extension;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\CheckboxSetField;
use SilverStripe\Forms\FormField;
use SilverStripe\UserForms\FormField\UserFormsCheckboxSetField;

class BootstrapFormField extends Extension
{

    private static $is_admin_url = null;

    public function onBeforeRender(FormField $formField)
    {
        /* We don't want this in the CMS */
        if ($this->isAdminURL()) {
            return;
        }

        $checkboxsetfield   = 'SilverStripe\\Forms\\CheckboxSetField';
        $optionsetfield     = 'SilverStripe\\Forms\\OptionsetField';
        $checkboxfield      = 'SilverStripe\\Forms\\CheckboxField';
        $textfield          = 'SilverStripe\\Forms\\TextField';
        $dropdownfield      = 'SilverStripe\\Forms\\DropdownField';
        $textareafield      = 'SilverStripe\\Forms\\TextareaField';
        $formaction         = 'SilverStripe\\Forms\\FormAction';

        if ($formField instanceof $checkboxsetfield) {
            $formField->setTemplate('Forms/BootstrapCheckboxSetField');
        } elseif ($formField instanceof $optionsetfield) {
            $formField->setTemplate('Forms/BootstrapOptionsetField');
        } elseif ($formField instanceof $checkboxfield) {
            // echo '<pre>';
            // print_r($formField->getTemplate());
            // echo '</pre>';
            // exit();
            // We overwrite default CheckboxField_holder.ss
        } elseif ($formField instanceof $textfield ||
            $formField instanceof $dropdownfield ||
            $formField instanceof $textareafield
        ) {
            $formField->addExtraClass('form-control');
        } elseif ($formField instanceof $formaction) {
            if ($formField->getAttribute('type') == 'submit') {
                $formField->addExtraClass('btn btn-primary');
            } else {
                $formField->addExtraClass('btn btn-default btn-secondary');
            }
        }
    }

    public function isAdminURL()
    {
        if (is_null(self::$is_admin_url)) {
            $req = Controller::curr()->getRequest()->getURL();
            self::$is_admin_url = preg_match('/^admin\//i', $req) ? true : false;
        }
        return self::$is_admin_url;
    }
}
