<?php

class cmsNewModel extends Model
{
    private $apiKey = "390bd92a6386d033462d30a200abaafd";

    /**
     * @param $url string
     * @param $postData array
     * @return array
     */
    private function postRequest($url, $postData)
    {
        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($postData),
            ],
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        return json_decode($result, true);
    }

    public function getValidateCode($sid, $password)
    {
        $result = $this->postRequest("http://www.alevel.com.cn/user/interface/checkuserlogin/", ["username" => $sid, "passwd" => $password, "validate_code" => $this->apiKey]);
        return $result;
    }
}