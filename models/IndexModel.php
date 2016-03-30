<?php 
class IndexModel {
    public $data;

    public function __construct() {

        $userData = User::getUserData(['username', 'first_name', 'last_name', 'user_id', 'email', 'profile_pic'])[0];

        $this->data['title'] = 'Home - NCube School';
        $this->data['first_name'] = ucwords($userData['first_name']);
        $this->data['last_name'] = ucwords($userData['last_name']);
        $this->data['token'] = Token::generate();
        $this->data['username'] = $userData['username'];

        if (empty($userData['profile_pic'])) {
            $this->data['profile_pic'] = '/public/images/profile-pic.png';
        } else {
            $this->data['profile_pic'] = '/data/images/profile/'.$userData['profile_pic'].'.jpg';
        }

        $feed = User::getFeed();
        if (!empty($feed)) {
            foreach($feed as $key => $value) {
                $id = $value['user_id'];
                $temp = User::getPublicUserData($id, ['username', 'profile_pic'])[0];

                foreach($temp as $key2 => $value2) {
                    $feed[$key][$key2] = $value2;
                }

                if ($feed[$key]['profile_pic'] === NULL) {
                    $feed[$key]['profile_pic'] = '/public/images/profile-pic.png';
                } else {
                    $feed[$key]['profile_pic'] = '/data/images/profile/'.$feed[$key]['profile_pic'].'.jpg';
                }
            }
        }

        $this->data['feed'] = $feed;

        // $requestData = User::getRequests();

        // if(isset($requestData->user_id)) {
        //     $username = User::getPublicUserData($requestData->user_id)->username;
        //     $requests[$username] = $requestData->type;
        // } else {
        //     foreach(User::getRequests() as $value) {

        //         $username = User::getPublicUserData($value->user_id)->username;
        //         $requests[$username] = $value->type;
        //     }
        // }
        // $this->data['request'] = $requests;
    }
}