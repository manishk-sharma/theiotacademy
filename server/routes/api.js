import express from 'express';
import AppController from '../controllers/AppController.js';
import LiveLeadController from '../controllers/LiveLeadController.js';

const router = express.Router();

// Home & Course routes
router.get('/home', AppController.getHomeData);
router.get('/courses', AppController.getCourses);

// Lead / Enquiry routes (exact 1:1 path as legacy PHP: LiveLead/allenquiryldsubmit)
router.post('/LiveLead/allenquiryldsubmit', LiveLeadController.allenquiryldsubmit);
router.post('/enquiry/submit', LiveLeadController.allenquiryldsubmit);

export default router;

