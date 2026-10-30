import CourseModel from '../models/CourseModel.js';

class AppController {
  static async getHomeData(req, res) {
    try {
      const courses = await CourseModel.getActiveCoursesList();
      res.json({
        status: 'success',
        data: {
          courses
        }
      });
    } catch (err) {
      console.error('Error fetching home data:', err);
      res.status(500).json({ status: 'error', message: err.message });
    }
  }

  static async getCourses(req, res) {
    try {
      const courses = await CourseModel.getActiveCoursesList();
      res.json({ status: 'success', data: courses });
    } catch (err) {
      res.status(500).json({ status: 'error', message: err.message });
    }
  }
}

export default AppController;

