<?php

namespace WeWork\Traits;

trait CorpIdTrait
{
    /**
     * @var string
     */
    protected $corpId;

    /**
     * @param string $corpId
     */
    public function setCorpId(string $corpId): void
    {
        $this->corpId = $corpId;
    }
}
