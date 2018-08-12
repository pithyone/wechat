<?php

namespace WeWork\Api;

use WeWork\Traits\HttpClientTrait;

class Invoice
{
    use HttpClientTrait;

    /**
     * 查询电子发票
     *
     * @param string $id
     * @param string $code
     * @return array
     */
    public function getInfo(string $id, string $code): array
    {
        return $this->httpClient->postJson('card/invoice/reimburse/getinvoiceinfo', ['card_id' => $id, 'encrypt_code' => $code]);
    }

    /**
     * 更新发票状态
     *
     * @param string $id
     * @param string $code
     * @param string $status
     * @return array
     */
    public function updateStatus(string $id, string $code, string $status): array
    {
        return $this->httpClient->postJson('card/invoice/reimburse/updateinvoicestatus', ['card_id' => $id, 'encrypt_code' => $code, 'reimburse_status' => $status]);
    }

    /**
     * 批量更新发票状态
     *
     * @param string $openid
     * @param string $status
     * @param array $list
     * @return array
     */
    public function updateStatusBatch(string $openid, string $status, array $list): array
    {
        return $this->httpClient->postJson('card/invoice/reimburse/updatestatusbatch', [
            'openid' => $openid,
            'reimburse_status' => $status,
            'invoice_list' => $list
        ]);
    }

    /**
     * 批量查询电子发票
     *
     * @param array $list
     * @return array
     */
    public function getInfoBatch(array $list): array
    {
        return $this->httpClient->postJson('card/invoice/reimburse/getinvoiceinfobatch', ['item_list' => $list]);
    }
}
