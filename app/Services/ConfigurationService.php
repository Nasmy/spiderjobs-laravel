<?php
/**
 * @name ConfigurationService
 *
 * @author Kanchana Fernando
 * @copyright Beyond Technologies (PVT) ltd
 */

namespace App\Services;

use App\Interfaces\ConfigurationRepositoryInterface;
use App\Models\Configuration;
use App\Traits\ApiResponse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

/**
 * @description The class contain all business logics related with configurations
 */
class ConfigurationService
{
    use ApiResponse;

    // Response success messages
    const MESSAGE_SUCCESS_CONFIG_CREATE = "Successfully created Configuration";
    const MESSAGE_FAILED_CONFIG_CREATE = "Configuration creation failed";
    const MESSAGE_SUCCESS_CONFIG_UPDATE = "Successfully Updated Configuration";
    const MESSAGE_FAILED_CONFIG_UPDATE = "Configuration update failed";

    // Configuration Keys
    const COMPANY_NAME = "company_name";
    const COMPANY_ADDRESS = "company_address";
    const COMPANY_MOBILE = "company_mobile";
    const COMPANY_LOCATION = "company_location";
    const COMPANY_LOGO = "company_logo";
    const CAREER_BASE_PAGE_URL = "career_base_page_url";
    const NOTIFICATION_EMAIL = "notification_email";
    const IS_PUBLISHED_LN = "is_published_ln";

    const PERMISSION_PARENT = 'configurations';

    public $isUpdate = false;


    public $configurationRepository;

    public function __construct(ConfigurationRepositoryInterface $configurationRepository)
    {
        $this->configurationRepository = $configurationRepository;
    }

    /**
     * @description retrive all configurations
     * @return mixed
     */
    public function all()
    {
        return $this->configurationRepository->all();
    }

    /**
     * @description retrive configurations info by configuration id
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->configurationRepository->findById($id);
    }

    /**
     * @description retrive configurations info by configuration key
     * @param $key
     * @return mixed
     */
    public function findByConfigKey($key)
    {
        return $this->configurationRepository->findByConfigKey($key);
    }

    /**
     * @description the method use for configuration update or create. If $isUpdate set true we assume as update
     * @param $data
     * @param null $id
     * @return Application|RedirectResponse|Redirector
     */
    public function createOrUpdate($data, $id = null)
    {
        if (isset($data[self::IS_PUBLISHED_LN]) && !empty($data[self::IS_PUBLISHED_LN])) {
            $data[self::IS_PUBLISHED_LN] = (string)$data[self::IS_PUBLISHED_LN];
        } else {
            $data[self::IS_PUBLISHED_LN] = '';
        }
        foreach ($data as $key => $value) {
            $config = $this->configurationRepository->findByKey($key)->first();
            if (!empty($config)) {
                $data['configuration_value'] = $value;
                $id = $config['id'];
                $this->configurationRepository->createOrUpdate($id, $data);
            }
        }
        return $this->configurationRepository->all();

    }

    /**
     * @description retrive admin email
     * @return mixed
     */
    public function getAdminEmail()
    {
        $configInfo = $this->findByConfigKey(self::NOTIFICATION_EMAIL);
        return !empty($configInfo)? $configInfo['configuration_value'] : Config::get('ADMIN_EMAIL', 'admin@company.com');
    }

    /**
     * @description this is use for set configurations for configuration seeder
     * @return array[]
     */
    public static function getConfigurations(): array
    {
        return [
            [
                "configuration_key" => "company_name",
                "configuration_value" => "Beyond",
            ],

            [
                "configuration_key" => "company_address",
                "configuration_value" => "No.50, Part Street, Col 05",
            ],

            [
                "configuration_key" => "company_mobile",
                "configuration_value" => "0714568952",
            ],

            [
                "configuration_key" => "company_location",
                "configuration_value" => "UK",
            ],

            [
                "configuration_key" => "company_logo",
                "configuration_value" => "",
            ],

            [
                "configuration_key" => "career_base_page_url",
                "configuration_value" => "",
            ],

            [
                "configuration_key" => "company_logo",
                "configuration_value" => "",
            ],
            [
                "configuration_key" => "notification_email",
                "configuration_value" => "kanchana.fernando@beyondtec.co",
            ],
            [
                "configuration_key" => "is_published_ln",
                "configuration_value" => "0",
            ],
        ];
    }
}
