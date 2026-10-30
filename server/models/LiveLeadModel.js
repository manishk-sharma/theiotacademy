import pool from '../config/db.js';

class LiveLeadModel {
  static async insertLiveLead(data) {
    const sql = `
      INSERT INTO leads (name, email_id, mobile_no, college_name, message, came_from, url_source)
      VALUES (?, ?, ?, ?, ?, ?, ?)
    `;
    const [result] = await pool.execute(sql, [
      data.name || null,
      data.email_id || null,
      data.mobile_no || null,
      data.college_name || null,
      data.message || null,
      data.came_from || null,
      data.url_source || null
    ]);
    return result.insertId;
  }
}

export default LiveLeadModel;

