import LiveLeadModel from '../models/LiveLeadModel.js';

class LiveLeadController {
  static async allenquiryldsubmit(req, res) {
    try {
      const {
        fullname,
        email,
        mobileno,
        collegename,
        message,
        form_name,
        url_source
      } = req.body;

      // Validation replicating CodeIgniter LiveLead::allenquiryldsubmit rules
      if (!fullname || fullname.trim() === '') {
        return res.json({ message: 'error', response: 'Name Cannot Be Empty.' });
      }
      if (!mobileno || mobileno.toString().trim().length < 10) {
        return res.json({ message: 'error', response: 'Mobile No. Must Be a Valid Number (minimum 10 digits).' });
      }
      if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        return res.json({ message: 'error', response: 'Email Must Be a Valid Email.' });
      }

      const data = {
        name: fullname,
        email_id: email,
        mobile_no: mobileno,
        college_name: collegename || '',
        message: message || '',
        came_from: form_name || 'Home Page',
        url_source: url_source || ''
      };

      const cid = await LiveLeadModel.insertLiveLead(data);

      if (cid > 0) {
        return res.json({
          message: 'success',
          response: 'Enquiry Submitted Successfully!'
        });
      } else {
        return res.json({
          message: 'sererror',
          response: 'Message Failed! Try Again'
        });
      }
    } catch (err) {
      console.error('Error submitting enquiry:', err);
      return res.status(500).json({
        message: 'error',
        response: 'Server error processing request'
      });
    }
  }
}

export default LiveLeadController;

