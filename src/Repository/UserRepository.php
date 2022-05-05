<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
// use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry,EntityManagerInterface $manager)
    {
        parent::__construct($registry, User::class);
        $this->manager = $manager;
    }

    public function saveUser($fullName, $username, $email, $password, $roles)
    {
        $newUser = new User();

        $newUser->setFullName($fullName);
        $newUser->setUserName($username);
        $newUser->setEmail($email);
        $newUser->setPassword($password);
        $newUser->setRoles($roles);

        $this->manager->persist($newUser);
        $this->manager->flush();
    }

    public function update(User $user): User
    {
        $this->manager->persist($user);
        $this->manager->flush();

        return $user;
    }

    public function removeUser(User $user)
    {
        $this->manager->remove($user);
        $this->manager->flush();
    }

    // returns users array to use in the ws: dRoman
    /* public function getUsersArray()
    {
        $em = $this->getEntityManager();
        $dql = "SELECT u FROM App:User u"; 
        // symfony_demo_user sqlite table as User as u

        return $em->createQuery($dql)->getArrayResult();
    } */

    // /**
    //  * @return Pet[] Returns an array of Pet objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Pet
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
?>