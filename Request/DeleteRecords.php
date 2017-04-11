<?php
namespace Christiaan\ZohoCRMClient\Request;

/**
 * DeleteRecords API Call
 *
 * You can use this method to retrieve individual records by record ID.
 *
 * @see https://www.zoho.com/crm/help/api/deleterecords.html
 */
class DeleteRecords  extends AbstractRequest
{
    protected function configureRequest()
    {
        $this->request
            ->setMethod('deleteRecords');
    }

    /**
     * @param string $id
     * @return DeleteRecords
     */
    public function id($id)
    {
        $this->request->setParam('id', $id);

        return $this;
    }
	
	public function idlist( $idlist)
    {
		$this->request->setParam('version', 5);
        $this->request->setParam('idlist', $idlist);

        return $this;
    }
}
