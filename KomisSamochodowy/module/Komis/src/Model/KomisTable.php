<?php
namespace Komis\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class KomisTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function getKomis($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }

        return $row;
    }

    public function saveKomis(Komis $komis)
    {
        $data = [
            'marka' => $komis->marka,
            'model'  => $komis->model,
            'img'  => $komis->img,
            'year'  => $komis->year,
            'desc'  => $komis->desc,
        ];

        $id = (int) $komis->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        if (! $this->getKomis($id)) {
            throw new RuntimeException(sprintf(
                'Cannot update komis with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deleteKomis($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}
