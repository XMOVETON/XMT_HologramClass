<?php

namespace xmt\floatingtext;

use pocketmine\Server;
use pocketmine\level\particle\FloatingTextParticle;
use pocketmine\level\Position;

class HologramAPI
{

    /**
     * @var Position
     */
    private $pos;

    /**
     * @var array
     */
    private $text;

    /**
     * @var array
     */
    private $particle = [];

    /**
     * @param Position $pos
     */
    public function __construct(Position $pos) {
        $this->pos = $pos;
    }

    /**
     * @return array
     */
    public function getText()
    {
        return ...; // array text
    }

    /**
     * @return array
     */
    public function create()
    {
        for ($i = 0; $i < count($this->getText()); $i++) { 
            $this->particle[] = new FloatingTextParticle($this->pos, "", "");
            $this->pos->y -= 0.27;
        }
        return $this->particle;
    }

    /**
     * @return array
     */
    public function update()
    {
        $texts = [];
        foreach ($this->getText() as $text) {
            $texts[] = $text;
        }

        foreach ($this->particle as $index => $particle) {
            $particle->setTitle($texts[$index]);
            Server::getInstance()->getDefaultLevel()->addParticle($particle);
        }
        return $texts;
    }   
}