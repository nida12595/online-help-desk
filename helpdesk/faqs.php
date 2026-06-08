<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Help Desk FAQs</title>

  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background: #f4f4f8;
    }

    .faq-section {
      display: flex;
      justify-content: space-between;
      max-width: 1100px;
      margin: 40px auto;
      padding: 20px;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0px 4px 12px rgba(0,0,0,0.1);
      gap: 30px;
    }

    
    .faq-left {
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    .faq-left h2 {
      font-size: 34px;      
      margin-top: 35px;   
      margin-bottom: 40px;  
    }

    .contact-box {
      background: #f0f0ff;
      padding: 20px;
      border-radius: 10px;
      margin-top: 20px;
    }

    .contact-box h3 {
      margin: 0 0 10px;
    }

   
    .btn {
      display: inline-block;
      margin-top: 10px;
      padding: 10px 16px;
      background: linear-gradient(to right, #b674ec, #ca74ec);
      color: white;
      text-decoration: none;
      border-radius: 6px;
      font-size: 14px;
    }

    .btn:hover {
      background: linear-gradient(to right, #ab56cc, #b674ec);
    }

    
    .faq-right {
      flex: 2;
    }

    .category-title {
      margin: 20px 0 10px;
      font-size: 20px;
      color: #333;
    }

    
    .faq-item {
      border: 1px solid #eee;
      border-radius: 8px;
      margin-bottom: 12px;
      overflow: hidden;
      background: #fafafa;
    }

    .faq-item input {
      display: none;
    }

    .faq-question {
      display: block;
      padding: 15px;
      cursor: pointer;
      position: relative;
      font-weight: 500;
      transition: background 0.3s;
    }

    .faq-question:hover {
      background: #f0f0f5;
    }

    .faq-question::after {
      content: "▾";
      position: absolute;
      right: 20px;
      font-size: 18px;
      transition: transform 0.3s;
    }

    .faq-item input:checked + .faq-question::after {
      content: "▴";
    }

    .faq-answer {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.3s ease;
      padding: 0 15px;
      font-size: 14px;
      color: #555;
    }

    .faq-item input:checked ~ .faq-answer {
      max-height: 200px;
      padding: 10px 15px 15px;
    }

    
    @media (max-width: 768px) {
      .faq-section {
        flex-direction: column;
        padding: 15px;
      }
    }
      /* Back Button Styling */
.back-container {
  padding: 20px 40px 0 40px;
}

.back-btn {
  background: linear-gradient(to right, #b674ec, #ca74ec);
  color: white;
  border: none;
  padding: 8px 16px;
  border-radius: 20px;
  font-size: 14px;
  cursor: pointer;
  transition: 0.3s;
}

.back-btn:hover {
  background: linear-gradient(to right, #ab56cc, #b674ec);
}
  </style>
</head>
<body>
  <div class="back-container">
  <button onclick="goBack()" class="back-btn">
    ← Back
  </button>
</div>
  <section class="faq-section">
    
    <div class="faq-left">
      <h2>Frequently asked questions</h2>

      <div class="contact-box">
        <h3>Still have questions?</h3>
        <p>Can’t find the answer to your questions? Send us an email and we’ll get back to you as soon as possible.</p>
        <a href="https://mail.google.com/mail/?view=cm&fs=1&to=thehelpdeskportal@gmail.com" class="btn" target="_blank">Send Email</a>
      </div>
    </div>

    
    <div class="faq-right">

      
      <h3 class="category-title">📘 Academics & Study Materials</h3>

      <div class="faq-item">
        <input type="checkbox" id="q1">
        <label for="q1" class="faq-question">Where can I find lecture notes and study materials?</label>
        <div class="faq-answer">
          <p>Lecture notes and study materials are available in the <b>Study Materials</b> tab. 
          We regularly upload PDFs, slides, and guides.</p>
        </div>
      </div>

      <div class="faq-item">
        <input type="checkbox" id="q2">
        <label for="q2" class="faq-question">Where can I find the top websites and video tutorials for my subjects?</label>
        <div class="faq-answer">
          <p>You can explore the <b>Study Materials</b> tab, where we have curated the most useful 
            websites and video tutorials that are best recommended.</p>
        </div>
      </div>

      <div class="faq-item">
        <input type="checkbox" id="q3">
        <label for="q3" class="faq-question">Is there also any pdf sources to go through?</label>
        <div class="faq-answer">
          <p>Yes, additional PDF resources such as e-books and reference guides 
              are uploaded in the <b>Study Materials</b> tab for easy access.</p>
        </div>
      </div>

      <div class="faq-item">
        <input type="checkbox" id="q4">
        <label for="q4" class="faq-question">What books are recommended for AI core subjects?</label>
        <div class="faq-answer">
          <p> Recommended books :<br><br>

            - <b>Machine Learning:</b> Machine Learning by Tom M. Mitchell (McGraw Hill India Edition)<br>

            - <b>Data Structures:</b> Data Structures Using C by Reema Thareja (Oxford University Press)<br>
            Data Structures Through C in Depth by Deepali Srivastava<br>

            - <b>Artificial Intelligence:</b> Artificial Intelligence by Saroj Kaushik (Cengage India)<br>
            Artificial Intelligence by Dan W. Patterson (Indian Edition)<br>

            - <b>Python Programming:</b> Programming with Python by Reema Thareja (Oxford University Press)<br>
          </p>
        </div>
      </div>

      
      <h3 class="category-title">⚙ Complaints & Support</h3>

      <div class="faq-item">
        <input type="checkbox" id="q5">
        <label for="q5" class="faq-question">How do I raise a complaint (academic/technical)?</label>
        <div class="faq-answer">
          <p>You can raise a complaint through the <b>Complaints</b> tab.  
             Just fill out the form with details of your issue and submit it. </p>
        </div>
      </div>

      <div class="faq-item">
        <input type="checkbox" id="q6">
        <label for="q6" class="faq-question">How long does it take to resolve a complaint?</label>
        <div class="faq-answer">
          <p>Complaints are usually reviewed quickly and resolved as soon as possible.  
             You will receive an update once your complaint has been addressed.</p>
        </div>
      </div>

      <div class="faq-item">
        <input type="checkbox" id="q7">
        <label for="q7" class="faq-question">Can I get updates about my complaint on my mobile/email?</label>
        <div class="faq-answer">
          <p>Yes, once you submit a complaint, you will automatically receive updates on its progress through your registered email.</p>
        </div>
      </div>

    </div>
  </section>
<script>
function goBack() {
  window.history.back();
}
</script>
</body>
</html>