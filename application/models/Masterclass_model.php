<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masterclass_model extends CI_Model
{
    private $table = 'masterclass_settings';

    private $allowed_pages = [
        'da-genai-masterclass',
        'data-analytics-gen-ai-masterclass'
    ];

    public function is_allowed_page($page_slug)
    {
        return in_array($page_slug, $this->allowed_pages, true);
    }

    public function get_all_settings()
    {
        return $this->db
            ->where_in('page_slug', $this->allowed_pages)
            ->get($this->table)
            ->result_array();
    }

    public function get_settings($page_slug)
    {
        if (!$this->is_allowed_page($page_slug)) {
            return null;
        }

        return $this->db
            ->where('page_slug', $page_slug)
            ->get($this->table)
            ->row_array();
    }

    public function update_date($page_slug, $date_time)
    {
        if (!$this->is_allowed_page($page_slug)) {
            return false;
        }

        return $this->db
            ->where('page_slug', $page_slug)
            ->update($this->table, [
                'masterclass_date_time' => $date_time
            ]);
    }

    public function get_formatted_date($page_slug)
    {
        $settings = $this->get_settings($page_slug);

        if (!$settings) return null;

        $date = new DateTime(
            $settings['masterclass_date_time'],
            new DateTimeZone('Asia/Kolkata')
        );

        return $date->format('j F Y, g:i A');
    }

    public function get_iso_date($page_slug)
    {
        $settings = $this->get_settings($page_slug);

        if (!$settings) return null;

        $date = new DateTime(
            $settings['masterclass_date_time'],
            new DateTimeZone('Asia/Kolkata')
        );

        return $date->format('Y-m-d\TH:i:sP');
    }

    public function get_whatsapp_link()
{
    $settings = $this->db
        ->select('whatsapp_link')
        ->where_in('page_slug', $this->allowed_pages)
        ->where('whatsapp_link IS NOT NULL', null, false)
        ->where('whatsapp_link !=', '')
        ->limit(1)
        ->get($this->table)
        ->row_array();

    return $settings ? $settings['whatsapp_link'] : '';
}


public function update_whatsapp_link($whatsapp_link)
{
    return $this->db
        ->where_in('page_slug', $this->allowed_pages)
        ->update($this->table, [
            'whatsapp_link' => $whatsapp_link
        ]);
}
}