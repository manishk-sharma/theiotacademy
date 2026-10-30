// 1:1 Matching helper functions for CodeIgniter's utility_helper.php and url_helper

const BASE_URL = import.meta.env.VITE_BASE_URL || '/';
const API_BASE_URL = import.meta.env.VITE_API_URL || 'http://localhost:5000/api';

export function base_url(path = '') {
  const cleanPath = path.startsWith('/') ? path.slice(1) : path;
  return `${BASE_URL}${cleanPath}`;
}

export function site_url(path = '') {
  return base_url(path);
}

export function asset_url(path = '') {
  const cleanPath = path.startsWith('/') ? path.slice(1) : path;
  return `/assets/${cleanPath}`;
}

export function aws_asset_url(path = '') {
  const cleanPath = path.startsWith('/') ? path.slice(1) : path;
  return `https://s3-tiaimgv1.s3.ap-south-1.amazonaws.com/images/${cleanPath}`;
}

export function blog_header_image_url(path = '') {
  return `${base_url('uploads/blogdata/headerimage/')}${path}`;
}

export function blog_featured_image_url(path = '') {
  return `${base_url('uploads/blogdata/featuredimage/')}${path}`;
}

export function resume_url(path = '') {
  return `${base_url('uploads/resume/')}${path}`;
}

export function event_intro_image_url(path = '') {
  return `${base_url('uploads/eventdata/introimage/')}${path}`;
}

export function event_doc_url(path = '') {
  return `${base_url('uploads/eventdata/documents/')}${path}`;
}

export function event_main_image_url(path = '') {
  return `${base_url('uploads/eventdata/mainimage/')}${path}`;
}

export { API_BASE_URL };

