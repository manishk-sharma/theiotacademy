import mysql from 'mysql2/promise';
import dotenv from 'dotenv';
dotenv.config();

const pool = mysql.createPool({
  host: process.env.DB_HOST || 'localhost',
  user: process.env.DB_USER || 'root',
  password: process.env.DB_PASSWORD || '',
  database: process.env.DB_NAME || 'theiotacademy',
  waitForConnections: true,
  connectionLimit: 10,
  queueLimit: 0
});

pool.getConnection()
  .then((conn) => {
    console.log(`[Database] Connected successfully to MySQL database: ${process.env.DB_NAME || 'theiotacademy'}`);
    conn.release();
  })
  .catch((err) => {
    console.error('[Database] Connection failed:', err.message);
  });

export default pool;

