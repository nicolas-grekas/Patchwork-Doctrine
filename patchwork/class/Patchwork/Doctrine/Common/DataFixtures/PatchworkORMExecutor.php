<?php /****************** vi: set fenc=utf-8 ts=4 sw=4 et: *****************
 *
 *   Copyright : (C) 2012 Nicolas Grekas. All rights reserved.
 *   Email     : p@tchwork.org
 *   License   : http://www.gnu.org/licenses/agpl.txt GNU/AGPL
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU Affero General Public License as
 *   published by the Free Software Foundation, either version 3 of the
 *   License, or (at your option) any later version.
 *
 ***************************************************************************/

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
        $this->persistQueue = array();
        $this->relationships = array();
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
