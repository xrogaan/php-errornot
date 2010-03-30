<?php
require_once 'HTTP/Request2.php';
require_once dirname(__FILE__).'/../errornot.php';
require_once 'mock.php';

class MockAdapterWithNotify extends Http_Request2_Adapter_Mock
{
    public function sendRequest(HTTP_Request2 $request)
    {
        exit(2);
    }
}

$mock_network = createMockRequest('test_ok.txt', 'MockAdapterWithNotify');
$errornot = Services_ErrorNot::getInstance(true)
    ->setUrl('http://localhost:3000/')
    ->setApi('test-key')
    ->registerExceptionHandler()
    ->setNetworkAdapter($mock_network);

throw new Exception('test');

exit(0);
