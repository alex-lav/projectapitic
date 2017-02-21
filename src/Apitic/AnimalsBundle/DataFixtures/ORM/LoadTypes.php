<?php

namespace Apitic\AnimalsBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Apitic\AnimalsBundle\Entity\Types;

class LoadTypes implements FixtureInterface
{
  public function load(ObjectManager $manager)
  {
    $infos_types = array(
      array('name' => 'Reptile', 'color' => '#99ff99'),
      array('name' => 'Mammifère', 'color' => '#e67300'),
      array('name' => 'Oiseaux', 'color' => '#ffff99')
    );

    foreach ($infos_types as $infos_type) {
      $type = new Types();
      $type->setName($infos_type['name']);
      $type->setColor($infos_type['color']);

      $manager->persist($type);
    }

    $manager->flush();
  }
}