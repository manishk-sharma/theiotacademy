<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AIChatbox extends CI_Controller {

     public function __construct() {
        parent::__construct();
        $this->load->database();

        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");

        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            http_response_code(200);
            exit();
        }
    }

     public function index() {

        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode([
                "status" => false,
                "message" => "Invalid request method"
            ]);
            return;
        }

        $input = json_decode(file_get_contents("php://input"), true);
        $userQuestion = strtolower(trim($input['message'] ?? ''));

    if (!$userQuestion) {
        echo json_encode([
            "status" => false,
            "message" => "Message required"
        ]);
        return;
    }

    $keywords = explode(" ", $userQuestion);

    $this->db->where('status', 1);
    $this->db->group_start();

    foreach ($keywords as $word) {
        if (strlen($word) > 3) {
            $this->db->or_like('course_title', $word);
        }
    }

    $this->db->group_end();
    $course = $this->db->get('courses')->row();

    if (!$course) {
        echo json_encode([
            "status" => false,
            "type" => "not_found",
            "message" => "Course not found"
        ]);
        return;
    }

    echo json_encode([
        "status" => true,
        "type" => "course_info",
        "data" => [

            // "course_id" => $course->course_id,
            // "cs_id" => $course->cs_id,
            "course_title" => $course->course_title,

            "duration_months" => $course->duration_months,
            "swt_duration" => $course->swt_duration,

            // "course_logo" => $course->course_logo,

            "course_fee" => $course->course_fee,
            "old_course_fee" => $course->old_course_fee,
            // "swt_course_fee" => $course->swt_course_fee,

            "training_mode" => $course->training_mode,
            "project_work" => $course->project_work,

            "hours_per_day" => $course->hours_per_day,
            "days_quantity" => $course->days_quantity,
            "modules_quantity" => $course->modules_quantity,

            "status" => $course->status,
            // "created_on" => $course->created_on,
            // "last_updated_on" => $course->last_updated_on
        ],
       
        "message" => "If you're interested, type 'Apply' to proceed."
    ]);
}


    private function callGroq($prompt) {

        if (!defined('GROQ_API_KEY')) {
            return "Groq API key missing.";
        }

        $data = [
            "model" => "llama-3.1-8b-instant",

            "messages" => [
                [
                    "role" => "system",
                    "content" => "You are official website course assistant. Answer only using provided course data. Do not add extra information."
                ],
                [
                    "role" => "user",
                    "content" => $prompt
                ]
            ],
            "temperature" => 0.3,
            "max_tokens" => 500
        ];

        $ch = curl_init("https://api.groq.com/openai/v1/chat/completions");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: Bearer " . GROQ_API_KEY
        ]);

        $result = curl_exec($ch);

        if ($result === false) {
            return "CURL ERROR: " . curl_error($ch);
        }

        curl_close($ch);

        $decoded = json_decode($result, true);

        if (isset($decoded['error'])) {
            return "Groq Error: " . $decoded['error']['message'];
        }

        if (!isset($decoded['choices'][0]['message']['content'])) {
            return "Groq response invalid.";
        }

        return trim($decoded['choices'][0]['message']['content']);
    }
}