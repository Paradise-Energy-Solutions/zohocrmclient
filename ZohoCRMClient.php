<?php
namespace Christiaan\ZohoCRMClient;

use Christiaan\ZohoCRMClient\Request;
use Christiaan\ZohoCRMClient\Transport;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;

/**
 * Main Class of the ZohoCRMClient library
 * Only use this class directly
 */
class ZohoCRMClient implements LoggerAwareInterface
{
    /** @var string */
    private $module;
    /** @var Transport\Transport */
    private $transport;
    /** @var LoggerInterface */
    private $logger;

    public function __construct($module, $authToken, $url = 'https://crm.zoho.com/crm/private/xml/')
    {
        $this->module = $module;

        if ($authToken instanceof Transport\Transport) {
            $this->transport = $authToken;
        } else {
            $this->transport = new Transport\XmlDataTransportDecorator(
                    new Transport\AuthenticationTokenTransportDecorator(
                        $authToken,
                        new Transport\BuzzTransport(
                            new \Buzz\Browser(new \Buzz\Client\Curl()),
                            $url
                        )
                    )
                );
        }
    }

    /**
     * Sets a logger instance on the object
     *
     * @param LoggerInterface $logger
     * @return void
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @return Request\GetRecords
     */
    public function getRecords()
    {
        return new Request\GetRecords($this->request());
    }
	
	 /**
     * @return Request\SearchRecords
     */
    public function searchRecords()
    {
        return new Request\SearchRecords($this->request());
    }

    /**
     * @param int|null $id
     * @return Request\GetRecordById
     */
    public function getRecordById($id = null)
    {
        $request = new Request\GetRecordById($this->request());
        if ($id !== null) {
            $request->id($id);
        }
        return $request;
    }
	
	/**
	 * @param int|null $id
     * @return Request\GetRelatedRecords
     */
    public function GetRelatedRecords( $module, $module_id, $fromIndex = 1, $toIndex = 200)
    {
		$request = new Request\GetRelatedRecords($this->request());
		$request->parentModule( $module);
		$request->id( $module_id);
		
		$request->index( $fromIndex, $toIndex);
		
        return $request;
    }
	

    /**
     * @return Request\InsertRecords
     */
    public function insertRecords()
    {
        return new Request\InsertRecords($this->request());
    }

    /**
     * @return Request\UpdateRecords
     */
    public function updateRecords()
    {
        return new Request\UpdateRecords($this->request());
    }
	
	/**
     * @return Request\DeleteRecords
     */
    public function deleteRecords($id)
    {
		$request = new Request\DeleteRecords($this->request());
		
		if(is_array( $id)){
			$request->idlist( implode( ';', $id));
		}else{
			$request->id( $id);
		}
        
		
        return $request;
    }

    /**
     * @return Request\GetFields
     */
    public function getFields()
    {
        return new Request\GetFields($this->request());
    }
	
	/**
     * @return Request\GetUsers
     */
    public function getUsers()
    {
        return new Request\GetUsers($this->request());
    }
	
	
	/**
     * @return Request\CreatorAddRecords
     */
    public function creatorAddRecords()
    {
        return new Request\CreatorAddRecords($this->request());
    }
	
	

    /**
     * @return \Christiaan\ZohoCRMClient\Transport\TransportRequest
     */
    protected function request()
    {
        $request = new Transport\TransportRequest($this->module);
        $request->setTransport($this->transport);
        return $request;
    }
}
