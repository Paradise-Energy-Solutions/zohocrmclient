<?php
namespace Christiaan\ZohoCRMClient\Request;

/**
 * GetRelatedRecords API Call
 *
 * You can use the getRelatedRecords method to fetch all data specified in the API request.
 *
 * @see https://www.zoho.com/crm/help/api/getrelatedrecords.html
 */
class GetRelatedRecords extends AbstractRequest
{
    protected function configureRequest()
    {
        $this->request
            ->setMethod('getRelatedRecords');
    }

    /**
     * @param string $id
     * @return GetRecordById
     */
    public function id($id)
    {
        $this->request->setParam('id', $id);

        return $this;
    }
	
	/**
     * @param string $parentModule
     * @return GetRecordById
     */
    public function parentModule( $parentModule)
    {
        $this->request->setParam( 'parentModule', $parentModule);

        return $this;
    }
	
	/**
     * @param string $toIndex
     * @return GetRecordById
     */
    public function index( $fromIndex, $toIndex)
    {
		$this->request->setParam( 'fromIndex', $fromIndex);
        $this->request->setParam( 'toIndex', $toIndex);

        return $this;
    }
	
	
}
