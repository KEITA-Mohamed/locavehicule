<?php

namespace App\Repository;

use App\Entity\Dispo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Dispo>
 */
class DispoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dispo::class);
    }

  public function searchDispo($dateDebut, $dateFin, $prixMax = null)
{
    $qb = $this->createQueryBuilder('d')
        ->where('d.dateDebut <= :dateDebut')
        ->andWhere('d.dateFin >= :dateFin')
        ->andWhere('d.statut = :statut')
        ->setParameter('dateDebut', new \DateTime($dateDebut))
        ->setParameter('dateFin', new \DateTime($dateFin))
        ->setParameter('statut', 'Disponible');

    if ($prixMax !== null && $prixMax !== '') {
        $qb->andWhere('d.prixParJour <= :prixMax')
           ->setParameter('prixMax', $prixMax);
    }
     // Inspecter la requête SQL générée
    //dd($qb->getQuery()->getSQL());
    return $qb->getQuery()->getResult();
}




    //    /**
    //     * @return Dispo[] Returns an array of Dispo objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('d.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Dispo
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}