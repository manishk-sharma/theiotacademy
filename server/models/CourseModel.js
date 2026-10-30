import pool from '../config/db.js';

class CourseModel {
  static async getActiveCoursesList() {
    const [rows] = await pool.query('SELECT * FROM courses WHERE status = 1');
    return rows;
  }

  static async getCoursesList() {
    const [rows] = await pool.query('SELECT * FROM courses');
    return rows;
  }

  static async getCourseBySlug(slug) {
    const [rows] = await pool.query('SELECT * FROM courses WHERE slug = ? AND status = 1', [slug]);
    return rows[0] || null;
  }
}

export default CourseModel;

