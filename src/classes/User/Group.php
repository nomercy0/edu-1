<?php 
class Group {
    public function isMember($id) {
        return (DB::fetchCount('group_user', array('user_id' => Session::get('user_id'), 'group_id' => $id, 'status' => 1)) === 1) ? TRUE : FALSE;
    }

    public function isAdmin($id) {
        return (DB::fetchCount('group_user', array('user_id' => Session::get('user_id'), 'group_id' => $id, 'type' => 'A', 'status' => 1)) === 1) ? TRUE : FALSE;
    }

    public function checkRequest($id) {
        return (DB::fetchCount('group_user', array('user_id' => Session::get('user_id'), 'group_id' => $id)) === 1) ? TRUE : FALSE;
    }

    public function joinAsMember($id) {
        if (!self::checkRequest($id)) {
            DB::insert('group_user', array('user_id' => Session::get('user_id'), 'group_id' => $id, 'type' => 'M', 'time' => time()));
            Notif::raiseNotif($id, 'GR');
            return TRUE;
        }
        return FALSE;
    }

    public function getRequestsIds($id) {
        return PhpConvert::toArray(DB::fetch(array('group_user' => ['user_id', 'time']), array('group_id' => $id, 'status' => 0)));
    }

    public function getRequests($id) {
        $reqs = self::getRequestsIds($id);
        $data = NULL;
        foreach($reqs as $value) {
            $data[] = User::getPublicUserData($value['user_id'])[0];
        }
        return $data;
    }

    public function getMembersIds($id) {
        return PhpConvert::toArray(DB::fetch('group_user', array('group_id' => $id, 'status' => 1)));
    }

    public function getMembers($id) {
        $reqs = self::getMembersIds($id);
        $data = NULL;
        foreach($reqs as $value) {
            $data[] = User::getPublicUserData($value['user_id'])[0];
        }
        return $data;
    }

    public function getMembersCount($id) {
        return DB::fetchCount('group_user', array('group_id' => $id, 'status' => 1));
    }

    public function acceptUser($id) {
        $data['user_id'] = User::getPublicUserId(Input::post('username'));
        $data['group_id'] = $id;
        DB::updateIf('group_user', array('status' => 1), $data);
        return TRUE;
    }

    public function rejectUser($id) {
        $data['user_id'] = User::getPublicUserId(Input::post('username'));
        $data['group_id'] = $id;
        $data['status'] = 0;
        DB::deleteIf('group_user', $data);
        return TRUE;
    }

    public function publicGroupExists($id) {
        $count = DB::fetchCount('group', array('group_id' => $id, 'public' => 1), 'group_id');
        if ($count === 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getGroupsIds() {
        return PhpConvert::toArray(DB::fetch('group_user', array('user_id' => Session::get('user_id'), 'status' => 1)));
    }

    public function getGroupData($id) {
        return PhpConvert::toArray(DB::fetch(array('group' => ['group_id', 'group_name', 'desp', 'group_pic', 'time']), array('group_id' => $id)));
    }

    public function getGroupsList() {
        $ids = self::getGroupsIds();

        $data = NULL;
        foreach($ids as $key => $value) {
            $data[] = self::getGroupData($value['group_id'])[0];
            $data[$key]['members'] = Group::getMembersCount($value['group_id']);
        }

        return $data;
    }
}