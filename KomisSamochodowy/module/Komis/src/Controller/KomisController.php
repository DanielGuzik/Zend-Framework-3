<?php

namespace Komis\Controller;


// Add the following import:
use Komis\Model\KomisTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Komis\Form\KomisForm;
use Komis\Model\Komis;

class KomisController extends AbstractActionController
{
    // Add this property:
    private $table;

    // Add this constructor:
    public function __construct(KomisTable $table)
    {
        $this->table = $table;
    }

    /* ... */

    public function indexAction()
    {
        return new ViewModel([
            'komiss' => $this->table->fetchAll(),
        ]);
    }
    public function addAction()
    {
        $form = new KomisForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if (! $request->isPost()) {
            return ['form' => $form];
        }

        $komis = new Komis();
        $form->setInputFilter($komis->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return ['form' => $form];
        }

        $komis->exchangeArray($form->getData());
        $this->table->saveKomis($komis);
        return $this->redirect()->toRoute('komis');
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if (0 === $id) {
            return $this->redirect()->toRoute('komis', ['action' => 'add']);
        }

        try {
            $komis = $this->table->getKomis($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('komis', ['action' => 'index']);
        }

        $form = new KomisForm();
        $form->bind($komis);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form];

        if (! $request->isPost()) {
            return $viewData;
        }

        $form->setInputFilter($komis->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return $viewData;
        }

        $this->table->saveKomis($komis);

        return $this->redirect()->toRoute('komis', ['action' => 'index']);
    }
    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('komis');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->table->deleteKomis($id);
            }

            return $this->redirect()->toRoute('komis');
        }

        return [
            'id'    => $id,
            'komis' => $this->table->getKomis($id),
        ];
    }

    public function viewAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('komis');
        }

        return [
            'id'    => $id,
            'komis' => $this->table->getKomis($id),
        ];
    }
}
