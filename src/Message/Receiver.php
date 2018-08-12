<?php

namespace WeWork\Message;

class Receiver
{
    /**
     * @var array
     */
    private $receiver;

    /**
     * @param string|array $user
     * @return void
     */
    public function setUser($user): void
    {
        $this->set('touser', $user);
    }

    /**
     * @param string|array $party
     * @return void
     */
    public function setParty($party): void
    {
        $this->set('toparty', $party);
    }

    /**
     * @param string|array $tag
     * @return void
     */
    public function setTag($tag): void
    {
        $this->set('totag', $tag);
    }

    /**
     * @return array
     */
    public function get(): array
    {
        return $this->receiver;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return void
     */
    private function set(string $key, $value): void
    {
        if (is_array($value)) {
            $value = implode('|', $value);
        }

        $this->receiver[$key] = $value;
    }
}
