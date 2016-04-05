<?php 
class Notif {
    public function getUnreadCount() {
        $user_id = Session::get('user_id');
        return DB::fetchcount('notification', array('to_id' => $user_id, 'status' => 0));
    }
    public function getUnreadData() {
        $user_id = Session::get('user_id');
        $data = PhpConvert::toArray(DB::fetch('notification', array('to_id' => $user_id, 'status' => 0)));
        foreach($data as $key => $value) {
            $temp = User::getPublicUserData($value['user_id'], ['username', 'first_name', 'last_name', 'profile_pic'])[0];
            $data[$key] = array_merge($data[$key], $temp);
        }
        return $data;
    }
}