<?php

namespace App\Service;

use App\Entity\AdmUser;
use App\Repository\AdmUserRepository;
use App\Service\AdmUserProfileService;

class AdmUserService
{
    /**
     * @var AdmUserRepository
     */
    private $repository;
    /**
     * @var AdmUserProfileService
     */
    private $service;

    public function __construct(AdmUserRepository $repository,
        AdmUserProfileService $service) {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function setTransientList(array $list): void
    {
        foreach ($list as $item)
        {
            $this->setTransient($item);
        }
    }

    public function setTransient(AdmUser $item): void
    {
        $obj = $this->service->getProfilesByUser($item->getId());
        foreach ($obj as $profile) {
            array_push($item->getAdmIdProfiles(), $profile->getId());
        }

        $listUserProfiles = array();
        foreach ($obj as $profile) {
            array_push($listUserProfiles, $profile->getDescription());
        }
        $item->setUserProfiles(implode(",", $listUserProfiles));
    }

    public function authenticate(string $login, string $password): AdmUser|null
    {
        $admUser = $this->repository->findOneUserByLogin($login);
        
        if ($admUser != null){
            if ($this->verifyPassword($password, $admUser->getPassword())){
                return $admUser;
            }
        }
        return null;
    }

    public function verifyPassword(string $password, string $hashPassword): bool
    {
        return password_verify($password, $hashPassword);
    }

    public function register(AdmUser $model): void
    {
        $model->setPassword(password_hash($model->getPassword(), PASSWORD_DEFAULT));
        /*
        $options = [
            'cost' => 10
        ];
        $model->setPassword(password_hash($model->getPassword(), PASSWORD_BCRYPT, $options));
        */
    }


}