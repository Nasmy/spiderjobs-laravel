<?php

namespace App\Services;

use App\Interfaces\ExperienceRepositoryInterface;
use App\Utils\ID;

class ExperienceService
{

    private $experienceRepository;

    const PERMISSION_PARENT = 'experience-level';

    public function __construct(ExperienceRepositoryInterface $experienceRepository)
    {
        $this->experienceRepository = $experienceRepository;
    }

    public function all()
    {
        return $this->experienceRepository->all();
    }

    public function createOrUpdate(array $data, $id = null)
    {
        if($id) {
            return $this->update($id, $data);
        }

        return $this->create($data);
    }

    public function update(string $id, array $data)
    {
        return $this->experienceRepository->update($id, $data);
    }

    public function create(array $data)
    {
        return $this->experienceRepository->create([
            'name' => $data['name'],
            'ident' => ID::fromString($data['name']),
            'description' => $data['description'],
        ]);
    }


    public function getAvailableLevels()
    {
        return [
            [
                'name' => 'ENTRY LEVEL',
                'description' => 'ENTRY LEVEL',
            ],
            [
                'name' => 'MID SENIOR LEVEL',
                'description' => 'MID SENIOR LEVEL',
            ],
            [
                'name' => 'DIRECTOR',
                'description' => 'DIRECTOR',
            ],
            [
                'name' => 'EXECUTIVE',
                'description' => 'EXECUTIVE',
            ],
            [
                'name' => 'INTERNSHIP',
                'description' => 'INTERNSHIP',
            ],
            [
                'name' => 'ASSOCIATE',
                'description' => 'ASSOCIATE',
            ],
            [
                'name' => 'NOT APPLICABLE',
                'description' => 'NOT APPLICABLE',
            ],
        ];
    }
}
