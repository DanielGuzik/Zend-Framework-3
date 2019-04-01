<?php
namespace Komis\Form;

use Zend\Form\Form;

class KomisForm extends Form
{
    public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('komis');

        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);
        $this->add([
            'name' => 'model',
            'type' => 'text',
            'options' => [
                'label' => 'Model',
            ],
        ]);
        $this->add([
            'name' => 'marka',
            'type' => 'text',
            'options' => [
                'label' => 'Marka',
            ],
        ]);
        $this->add([
            'name' => 'img',
            'type' => 'text',
            'options' => [
                'label' => 'Img',
            ],
        ]);
        $this->add([
            'name' => 'year',
            'type' => 'text',
            'options' => [
                'label' => 'Rok',
            ],
        ]);
        $this->add([
            'name' => 'desc',
            'type' => 'text',
            'options' => [
                'label' => 'Opis',
            ],
        ]);
        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Go',
                'id'    => 'submitbutton',
            ],
        ]);
    }
}