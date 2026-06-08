```php
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Feedback</title>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" rel="stylesheet">

<style>

body{
margin:0;
font-family:Arial, sans-serif;
background:#E6E6FA;
}

/* Sidebar */

.sidebar{
position:fixed;
left:0;
top:0;
width:220px;
height:100%;
background:#b674ec;
padding-top:20px;
color:white;
}

.sidebar h2{
text-align:center;
margin-bottom:30px;
}

.sidebar ul{
list-style:none;
padding:0;
}

.sidebar ul li{
padding:15px 20px;
}

.sidebar ul li a{
color:white;
text-decoration:none;
display:block;
}

.sidebar ul li:hover{
background:#7b5cd6;
}

/* Main content */

.main{
margin-left:220px;
padding:40px;
}

/* Feedback Card */

.feedback-card{
background:white;
padding:30px;
border-radius:12px;
max-width:600px;
box-shadow:0 4px 10px rgba(0,0,0,0.1);
}

.feedback-card h2{
color:#4B0082;
margin-bottom:20px;
}

.feedback-card input,
.feedback-card textarea{

width:100%;
padding:10px;
margin-top:8px;
margin-bottom:15px;
border:1px solid #ccc;
border-radius:6px;

}

.feedback-card button{

background:#9370DB;
border:none;
padding:10px 16px;
color:white;
border-radius:6px;
cursor:pointer;

}

.feedback-card button:hover{

background:#7b5cd6;

}

#sentimentResult{

font-weight:bold;
margin-bottom:10px;

}
.back-btn{

background:#b674ec;
border:none;
color:white;
padding:8px 14px;
border-radius:6px;
cursor:pointer;
margin-bottom:15px;

}

.back-btn:hover{

background:#7b5cd6;

}

</style>

</head>

<body>

<!-- Sidebar -->

<div class="sidebar">

<h2>HelpDesk</h2>

<ul>

<li>
<a href="dashboard.php">
<i class="fa fa-home"></i> Dashboard
</a>
</li>

<li>
<a href="study.php">
<i class="fa fa-book"></i> Study
</a>
</li>

<li>
<a href="../COMPLAINT/complaint.html">
<i class="fa fa-exclamation-circle"></i> Complaint
</a>
</li>

<li>
<a href="contact.php">
<i class="fa fa-envelope"></i> Contact
</a>
</li>

<li>
<a href="faqs.php">
<i class="fa fa-comments"></i> FAQs
</a>
</li>

<li>
<a href="feedback.php">
<i class="fa fa-star"></i> Feedback
</a>
</li>

<li>
<a href="logout_user.php">
<i class="fa fa-sign-out-alt"></i> Logout
</a>
</li>

</ul>

</div>


<div class="main">

<div class="feedback-card">
    <button class="back-btn" onclick="goBack()">
<i class="fa fa-arrow-left"></i> Back
</button>

<h2>Project Feedback</h2>

<label>Project Name</label>

<input
type="text"
id="projectName"
placeholder="Online Help Desk"
>

<label>Your Feedback</label>

<textarea
id="feedbackText"
rows="5"
placeholder="Write your feedback..."
onkeyup="analyzeSentiment()"
></textarea>

<p id="sentimentResult"></p>

<button onclick="submitFeedback()">
Submit Feedback
</button>

</div>

</div>


<script>

let sentiment="Neutral";

function analyzeSentiment(){

let text=document
.getElementById("feedbackText")
.value
.toLowerCase();

let positiveWords=[
"good","great","excellent",
"amazing","helpful","easy",
"awesome","perfect"
];

let negativeWords=[
"bad","slow","error",
"problem","issue",
"difficult","worst"
];

let score=0;

positiveWords.forEach(word=>{
if(text.includes(word)){score++;}
});

negativeWords.forEach(word=>{
if(text.includes(word)){score--;}
});

if(score>0){

sentiment="Positive 😊";

}

else if(score<0){

sentiment="Negative 😡";

}

else{

sentiment="Neutral 😐";

}

document.getElementById("sentimentResult")
.innerHTML="AI Sentiment: "+sentiment;

}


window.submitFeedback = async function(){

let projectName=document.getElementById("projectName").value;
let feedbackText=document.getElementById("feedbackText").value;

try{

await addDoc(collection(db,"feedback"),{

projectName: projectName,
feedbackText: feedbackText,
sentiment: sentiment,
createdAt: new Date()

});

alert("Feedback submitted successfully!");

document.getElementById("feedbackText").value="";
document.getElementById("sentimentResult").innerHTML="";

}

catch(error){

console.error("Error:",error);

}

}
function goBack(){

window.location.href="dashboard.php";

}

</script>
<script type="module">

import { initializeApp } from "https://www.gstatic.com/firebasejs/12.10.0/firebase-app.js";
import { getFirestore, collection, addDoc } from "https://www.gstatic.com/firebasejs/12.10.0/firebase-firestore.js";

const firebaseConfig = {
apiKey: "AIzaSyCijq_8l8eVWTcG6k8R0Vip3O-YdBLZR_M",
authDomain: "online-helpdesk-facf3.firebaseapp.com",
projectId: "online-helpdesk-facf3",
storageBucket: "online-helpdesk-facf3.firebasestorage.app",
messagingSenderId: "25285155436",
appId: "1:25285155436:web:a82d55fe65419680fad649",
measurementId: "G-CMTTEV6955"
};

const app = initializeApp(firebaseConfig);
const db = getFirestore(app);

window.submitFeedback = async function(){

let projectName=document.getElementById("projectName").value;
let feedbackText=document.getElementById("feedbackText").value;

try{

await addDoc(collection(db,"feedback"),{

projectName: projectName,
feedbackText: feedbackText,
sentiment: sentiment,
createdAt: new Date()

});

alert("Feedback submitted successfully!");

}

catch(error){

console.error("Error:",error);

}

}

</script>
</body>
</html>
```