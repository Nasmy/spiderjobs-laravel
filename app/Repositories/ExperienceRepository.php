<?php

namespace App\Repositories;

use App\Interfaces\ExperienceRepositoryInterface;
use App\Models\JobExperienceLevel;
use App\Utils\ID;

class ExperienceRepository implements ExperienceRepositoryInterface
{

    public function all()
    {
        return JobExperienceLevel::all();
    }

    public function create(array $data)
    {
        return JobExperienceLevel::create([
            'name' => $data['name'],
            'ident' => ID::fromString($data['name']),
            'description' => $data['description'],
        ]);
    }

    public function update(string $id, array $data)
    {
        $jobExperienceLevel = JobExperienceLevel::findOrFail($id);

        if(isset($data['name'])) {
            $data['ident'] = ID::fromString($data['name']);
        }

        return $jobExperienceLevel->update($data);
    }
}