<?php

namespace Patchwork\Doctrine\Common\DataFixtures;

use Doctrine\ORM\EntityManager;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\SharedFixtureInterface;
use Patchwork\Doctrine\Common\DataFixtures\PatchworkAbstractFixture;

class PatchworkORMExecutor extends ORMExecutor
{
    protected $relationshipsRepository;
    protected $persistQueue;

    public function __construct(EntityManager $em, ORMPurger $purger = null)
    {
        parent::__construct($em, $purger);
        $this->persistQueue = array ();
        $this->relationships = array ();
    }

    public function load(ObjectManager $manager, FixtureInterface $fixture)
    {
        if ($fixture instanceof PatchworkAbstractFixture)
        {
            /* @var $fixture PatchworkAbstractFixture */
            $fixture->setRelationshipsRepository($this->relationshipsRepository);
            $fixture->setPersistQueue($this->persistQueue);
        }
        parent::load($manager, $fixture);
    }
}
