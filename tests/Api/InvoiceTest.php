<?php

namespace WeWork\Tests\Api;

use Mockery\MockInterface;
use WeWork\Api\Invoice;
use WeWork\Http\HttpClientInterface;
use WeWork\Tests\TestCase;

class InvoiceTest extends TestCase
{
    /**
     * @var MockInterface
     */
    protected $httpClient;

    /**
     * @var Invoice
     */
    protected $invoice;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->httpClient = \Mockery::mock(HttpClientInterface::class);

        $this->invoice = new Invoice();
    }

    /**
     * @return void
     */
    public function testGetInfo()
    {
        $this->httpClient->shouldReceive('postJson')
            ->once()
            ->with('card/invoice/reimburse/getinvoiceinfo', ['card_id' => 'foo', 'encrypt_code' => 'bar'])
            ->andReturn(['errcode' => 0]);

        $this->invoice->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->invoice->getInfo('foo', 'bar'));
    }

    /**
     * @return void
     */
    public function testUpdateStatus()
    {
        $this->httpClient->shouldReceive('postJson')
            ->once()
            ->with('card/invoice/reimburse/updateinvoicestatus', ['card_id' => 'foo', 'encrypt_code' => 'bar', 'reimburse_status' => 'baz'])
            ->andReturn(['errcode' => 0]);

        $this->invoice->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->invoice->updateStatus('foo', 'bar', 'baz'));
    }

    /**
     * @return void
     */
    public function testUpdateStatusBatch()
    {
        $this->httpClient->shouldReceive('postJson')
            ->once()
            ->with('card/invoice/reimburse/updatestatusbatch', [
                'openid' => 'foo',
                'reimburse_status' => 'bar',
                'invoice_list' => ['baz']
            ])
            ->andReturn(['errcode' => 0]);

        $this->invoice->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->invoice->updateStatusBatch('foo', 'bar', ['baz']));
    }

    /**
     * @return void
     */
    public function testGetInfoBatch()
    {
        $this->httpClient->shouldReceive('postJson')
            ->once()
            ->with('card/invoice/reimburse/getinvoiceinfobatch', ['item_list' => ['foo']])
            ->andReturn(['errcode' => 0]);

        $this->invoice->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->invoice->getInfoBatch(['foo']));
    }
}
