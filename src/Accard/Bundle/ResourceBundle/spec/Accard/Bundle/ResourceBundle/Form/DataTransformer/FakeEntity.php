<?php

namespace spec\Accard\Bundle\ResourceBundle\Form\DataTransformer;

class FakeEntity
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
}
