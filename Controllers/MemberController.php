<?php
class MemberController {
    private $MemberDAO;

    public function __construct(MemberDAO $MemberDAO) {
        $this->MemberDAO = $MemberDAO;
    }

    public function listMembers() {
        $members = $this->MemberDAO->getAll();
        include 'views/member_list.php';
    }

   

}