<?php

namespace App\Repositories;

use App\Interfaces\JobRepositoryInterface;
use App\Models\Job;

class JobRepository implements JobRepositoryInterface
{

    public function all()
    {
        return Job::all();
    }

    public function findById($id)
    {
        return Job::findOrFail($id);
    }

    public function findByApplyUrl(string $applyUrl)
    {
        return Job::where('job_apply_url', $applyUrl)->firstOrFail();
    }

    public function create(array $data)
    {
        return Job::create($data);
    }

    public function update(string $id, array $data)
    {
        $job = Job::findOrFail($id);

        return $job->update($data);
    }

    public function open()
    {
        return Job::where('status', '1')
            ->where('expiration_at', '>', now())
            ->get();
    }

    public function delete(string $id)
    {
        Job::findOrFail($id)->delete();
    }

    public function getCount()
    {
        return Job::count();
    }

    public function getLatest()
    {
        return Job::latest('updated_at')->first();
    }

    public function getRecent()
    {
        return Job::orderBy('updated_at', 'desc')->take(5)->get();
    }

    public function findByCreatedUser($user_id) {
        return Job::where('created_by', $user_id)->get();
    }

}
