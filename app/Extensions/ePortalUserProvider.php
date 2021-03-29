<?php
namespace App\Extensions;

use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use App\User;
use App\Class_name;

class ePortalUserProvider implements UserProvider
{
    private $token, $years, $months, $days;

    public function __construct()
    {
        $this->years = date("Y");
        $this->months = date("m");
        $this->days = date("d");
    }

    public function retrieveById($identifier)
    {
        return new User($identifier);
    }

    public function retrieveByToken($identifier, $token)
    {
        return null;
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        return null;
    }

    public function retrieveByCredentials(array $credentials)
    {
        if (!$this->validation($credentials)) {
            return null;
        }

        $array = $this->getUserData($credentials);

        if (in_array("User not exist!", $array, true)) {
            return null;
        }

        return new User($array);
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return $this->student($user);
    }

    private function validation(array $credentials)
    {
        $date_buf = $this->years . $this->months . $this->days;
        $this->token = hash('sha256', $date_buf . $credentials['username'] . 'nutc');
        $url = "https://apps.nutc.edu.tw/bin/api2/verify_user.php?username=" . $credentials['username'] . "&password=" . $credentials['password'] . "&token=" . $this->token;
        $response = $this->curl($url);
        $xml = simplexml_load_string($response);
        $json = json_encode($xml);
        $array = json_decode($json, TRUE);
        $verify = $array["result"];

        return $verify == "TRUE";
    }

    private function getUserData(array $credentials)
    {
        $url = "https://apps.nutc.edu.tw/bin/api2/user_info.php?username=" . $credentials['username'] . "&token=" . $this->token;
        $response = $this->curl($url);
        $array = json_decode($response, TRUE);
        return $array;
    }

    private function curl($url)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));
        return curl_exec($curl);
    }

    private function student(Authenticatable $user)
    {
        $sch_type = (int)$user->SCH_TYPE;
        $dep_id = (int)$user->DEP_ID;
        $dep_abbr = Class_name::where('SCH_TYPE', $sch_type)
            ->where('DEP_ID', $dep_id)->first()->DEP_ABBR;
        $serv_type = $user->SERV_TYPE;
        $isNotDepartmentOfDMStudent = $dep_abbr != '流管系' && $dep_abbr != '流管所' || $serv_type != 's';

        if ($isNotDepartmentOfDMStudent) {
            return false;
        }

        $class_deg = $this->years - 1911 - $user->CLASS_YY + ($this->months > 7 ? 1 : 0);
        $class_no = (int)substr($user->CLASS_NO, 9, 1);
        $conventChinese = ['', '一', '二', '三', '四'];

        if ($sch_type == 3) {
            $class_name = ['', 'A', 'B', 'C', 'D'];
            $sch = $class_name[$class_no];
            $class_deg += 2;
        }

        switch ($dep_abbr) {
            case '流管系':
                $user->identify = '流管' . $conventChinese[$class_deg] . ($sch ?? $class_no);
                break;
            case '流管所':
                $user->identify = '流管所研' . $conventChinese[$class_deg];
                break;
        }

        return true;
    }
}
