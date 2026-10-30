<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masterclass_settings extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->model('Masterclass_model');
        $this->load->library('session');
    }

    // Restrict settings changes to authorized users.
 private function require_settings_access()
{
    $access = $this->session->userdata('masterclass_settings_access');

    if (!$access) {
        return $this->output
            ->set_status_header(403)
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'success' => false,
                'message' => 'Unauthorized access',
                'session_id' => session_id(),
                'access_value' => $access,
                'session_data' => $this->session->userdata()
            ]));
    }

    return TRUE;
}

    // Settings page
   public function index()
{
    if (!$this->session->userdata('masterclass_settings_access')) {
    $this->load->view('masterclass_login');
    return;
}

    $this->load->view('masterclass_settings');
}

    // GET: Fetch latest date
 public function get_date()
{
    $page_slug = $this->input->get('page_slug', TRUE);

    if (!$this->Masterclass_model->is_allowed_page($page_slug)) {
        return $this->json_response([
            'success' => false,
            'message' => 'Invalid page'
        ], 400);
    }

    $settings = $this->Masterclass_model->get_settings($page_slug);

    if (!$settings) {
        return $this->json_response([
            'success' => false,
            'message' => 'Page settings not found'
        ], 404);
    }

    return $this->json_response([
        'success' => true,
        'page_slug' => $page_slug,
        'page_url' => base_url($page_slug),

        'date_time' =>
            $this->Masterclass_model->get_iso_date($page_slug),

        'formatted_date' =>
            $this->Masterclass_model->get_formatted_date($page_slug),

        'whatsapp_link' =>
            $this->Masterclass_model->get_whatsapp_link()
    ]);
}

    
  // POST: Update masterclass date
public function update_date()
{
    if (!$this->require_settings_access()) {
        return;
    }

    if (strtoupper($this->input->method()) !== 'POST') {
        return $this->json_response([
            'success' => false,
            'message' => 'Method not allowed'
        ], 405);
    }

    // Selected masterclass page
    $page_slug = trim(
        (string) $this->input->post('page_slug', TRUE)
    );

    if (!$this->Masterclass_model->is_allowed_page($page_slug)) {
        return $this->json_response([
            'success' => false,
            'message' => 'Invalid masterclass page'
        ], 400);
    }

    // Date, time and global WhatsApp link
    $date = trim((string) $this->input->post('date'));
    $time = trim((string) $this->input->post('time'));

    $whatsapp_link = trim(
        (string) $this->input->post('whatsapp_link')
    );

    if (empty($date) || empty($time)) {
        return $this->json_response([
            'success' => false,
            'message' => 'Date and time are required'
        ], 422);
    }

    if (empty($whatsapp_link)) {
        return $this->json_response([
            'success' => false,
            'message' => 'WhatsApp link is required'
        ], 422);
    }

    // Validate WhatsApp URL
    if (
        !filter_var($whatsapp_link, FILTER_VALIDATE_URL) ||
        !preg_match(
            '~^https://(chat\.whatsapp\.com|wa\.me)/~i',
            $whatsapp_link
        )
    ) {
        return $this->json_response([
            'success' => false,
            'message' => 'Please enter a valid WhatsApp link'
        ], 422);
    }

    // Validate date/time
    $dateTime = DateTime::createFromFormat(
        '!Y-m-d H:i',
        $date . ' ' . $time,
        new DateTimeZone('Asia/Kolkata')
    );

    $errors = DateTime::getLastErrors();

    if (
        !$dateTime ||
        (
            $errors !== false &&
            (
                $errors['warning_count'] > 0 ||
                $errors['error_count'] > 0
            )
        ) ||
        $dateTime->format('Y-m-d H:i') !== $date . ' ' . $time
    ) {
        return $this->json_response([
            'success' => false,
            'message' => 'Invalid date or time'
        ], 422);
    }

    $newDateTime = $dateTime->format('Y-m-d H:i:s');

    // Date/time only selected page ka update hoga
    $updated = $this->Masterclass_model->update_date(
        $page_slug,
        $newDateTime
    );

    if (!$updated) {
        return $this->json_response([
            'success' => false,
            'message' => 'Unable to update date'
        ], 500);
    }

    // WhatsApp link GLOBAL update hoga
    $whatsappUpdated =
        $this->Masterclass_model->update_whatsapp_link(
            $whatsapp_link
        );

    if (!$whatsappUpdated) {
        return $this->json_response([
            'success' => false,
            'message' => 'Unable to update WhatsApp link'
        ], 500);
    }

    return $this->json_response([
        'success' => true,

        'message' =>
            'Masterclass settings updated successfully',

        'page_slug' => $page_slug,

        'page_url' =>
            base_url($page_slug),

        'date_time' =>
            $this->Masterclass_model->get_iso_date($page_slug),

        'formatted_date' =>
            $this->Masterclass_model->get_formatted_date($page_slug),

        'whatsapp_link' =>
            $this->Masterclass_model->get_whatsapp_link(),

        'csrf_token_name' =>
            $this->security->get_csrf_token_name(),

        'csrf_hash' =>
            $this->security->get_csrf_hash()
    ]);
}

    private function json_response($data, $status = 200)
    {
        return $this->output
            ->set_status_header($status)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($data));
    }

   public function login()
{
    if ($this->input->method() !== 'post') {
        show_404();
        return;
    }

    $password = (string) $this->input->post('password');

    // Load password hash from config file
    $this->config->load('masterclass');

    $hash = $this->config->item('masterclass_password_hash');

    // Verify password
    if (!$hash || !password_verify($password, $hash)) {

        $this->session->set_flashdata(
            'error',
            'Invalid password'
        );

        redirect('masterclass-settings');
        return;
    }

    // Regenerate session after successful login
    $this->session->sess_regenerate(TRUE);

    $this->session->set_userdata(
        'masterclass_settings_access',
        TRUE
    );

    redirect('masterclass-settings');
}

public function logout()
{
    if (strtoupper($this->input->method()) !== 'POST') {
        show_404();
        return;
    }

    // Remove masterclass authentication session
    $this->session->unset_userdata(
        'masterclass_settings_access'
    );

    // Regenerate session ID
    $this->session->sess_regenerate(TRUE);

    // Redirect to login page
    redirect('masterclass-settings');
}


}

