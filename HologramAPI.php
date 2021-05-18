<?php

namespace XMT\HologramAPI;

use XMT\HologramAPI\Entity\FTP;

use pocketmine\{
    plugin\PluginBase,
    level\Position
};

class HologramAPI extends PluginBase
{
    const LINE_OFFSET = 0.37;

    /**
     * @var FTP $particle[]
     */
    private $particle = [];

    /**
     * @var Position
     */
    public $position;

    /**
     * @var array
     */
    public $text = [];

    public function onEnable()
    {
        // 
    }

    /**
     * @return array
     */
    public function create(Position $pos, $text = [], $rand = null)
    {
        $this->position = $pos;

        for ($i = 0; $i < count($text); $i++) { 
            $this->text = array_merge($text, [rand()]);
            $this->particle[] = new FTP($this->position);
            $this->position->y -= self::LINE_OFFSET;
        }
        return $this->particle;
    }

    public function update()
    {
        $texts = [];
        foreach ($this->text as $text) {
            $texts[] = $text;
        }

        foreach ($this->create as $index => $particle) {
            $particle->setText($texts[$index]);
            $this->getServer()->getDefaultLevel()->addParticle($particle);
        }
    }
}