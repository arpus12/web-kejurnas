<?php

function check_login()
{
    $ci = get_instance();

    if (!$ci->session->userdata('email')) {
        redirect('welcome');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);

        $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();

        $menuId = $queryMenu['id'];

        $menuAcces = $ci->db->get_where('user_access_menu', [
            'role_id' => $role_id,
            'menu_id' => $menuId
        ]);

        if ($menuAcces->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }
}
