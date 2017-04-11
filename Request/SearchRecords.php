<?php
namespace Christiaan\ZohoCRMClient\Request;

/**
 * searchRecords API Call
 *
 * You can use the searchRecords method to get the list of records that meet your search criteria.
 *
 * @see https://www.zoho.com/crm/help/api/searchrecords.html
 */
class SearchRecords extends AbstractRequest
{
    protected function configureRequest()
    {
        $this->request
            ->setMethod('searchRecords')
            ->setParam('selectColumns', 'All');
    }
	
	
	
	
	
	
	
	//	ex. (((Last Name:Steve)AND(Company:Zillum))OR(Lead Status:Contacted))
	
    /**
     * @param string $criteria
     * @return SearchRecords
     */
    public function criteria( $criteria)
    {
        $this->request->setParam('criteria', $criteria);

        return $this;
    }
}
