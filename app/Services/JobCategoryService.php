<?php
/**
 * @name JobCategoryService
 *
 * @author Kanchana Fernando
 * @copyright Beyond Technologies (PVT) ltd
 */

namespace App\Services;

use App\Interfaces\JobCategoryRepositoryInterface;
use App\Traits\ApiResponse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

/**
 * @description The class contain all business logics related with jobCategories
 */
class JobCategoryService
{
    use ApiResponse;

    // Response success messages
    const MESSAGE_SUCCESS_CREATE = "Successfully created Job Category";
    const MESSAGE_FAILED_CREATE = "Job Category creation failed";
    const MESSAGE_SUCCESS_UPDATE = "Successfully Updated Job Category";
    const MESSAGE_FAILED_UPDATE = "Job Category update failed";

    const PERMISSION_PARENT = 'job-category';

    public $isUpdate = false;


    public $jobCategoryRepository;

    public function __construct(JobCategoryRepositoryInterface $jobCategoryRepository)
    {
        $this->jobCategoryRepository = $jobCategoryRepository;
    }

    /**
     * @description retrive all jobCategories
     * @return mixed
     */
    public function all()
    {
        return $this->jobCategoryRepository->all();
    }

    /**
     * @description retrive jobcategories info by jobcategory id
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->jobCategoryRepository->findById($id);
    }

    /**
     * @description the method use for jobcategory update or create. If $isUpdate set true we assume as update
     * @param $data
     * @param null $id
     * @return Application|RedirectResponse|Redirector
     */
    public function createOrUpdate($data, $id = null)
    {
        $this->isUpdate = $id != null;
        try {
            $this->jobCategoryRepository->createOrUpdate($id, $data);
            ($this->isUpdate) ? session()->flash('jobcat-creation-success', self::MESSAGE_SUCCESS_UPDATE) : session()->flash('jobcat-creation-success', self::MESSAGE_SUCCESS_CREATE);
            return redirect('job-category');
        } catch (\Exception $e) {
            // TODO need to handle common way to implement both api and web
            ($this->isUpdate) ? session()->flash('jobcat-creation-fail', self::MESSAGE_FAILED_UPDATE) : session()->flash('jobcat-creation-fail', self::MESSAGE_FAILED_CREATE);
            return back();
        }
    }

    /**
     * @description deleting job category
     * @param $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        try {
            $jobCat = $this->jobCategoryRepository->delete($id);
            return $this->sendResponse($jobCat, 'Job Category successfully deleted ');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), '401');
        }
    }

    /**
     * @return array
     */
    public function getAvailableCategories(): array
    {
        return [
            [
                'name' => 'Accounting / Auditing',
                'description' => 'Accounting / Auditing'
            ], [
                'name' => 'Administrative',
                'description' => 'Administrative'
            ], [
                'name' => 'Business Analyst',
                'description' => 'Business Development'
            ], [
                'name' => 'Community Manager',
                'description' => 'Community Manager'
            ], [
                'name' => 'Front End Developer',
                'description' => 'Community Manager'
            ], [
                'name' => 'Information System Architect',
                'description' => 'Information System Architect'
            ], [
                'name' => 'Project Management',
                'description' => 'Project Management'
            ],[
                'name' => 'IT Project Manager',
                'description' => 'IT Project Manager'
            ], [
                'name' => 'SEO Consultant',
                'description' => 'SEO Consultant'
            ], [
                'name' => 'Fullstack Engineer',
                'description' => 'Fullstack Engineer'
            ],[
                'name' => 'Backend Developer',
                'description' => 'Backend Developer'
            ],[
                'name' => 'UX Designer',
                'description' => 'UX Designer'
            ]
        ];
    }
}
