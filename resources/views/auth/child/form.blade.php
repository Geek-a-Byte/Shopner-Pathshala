<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit] {
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 200px;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
</style>
</head>
<body>

<h2>Child Form</h2>


<div class="container">
  <form action="/action_page.php">
    <div class="row">
      <div class="col-25">
        <label for="fname">Name</label>
      </div>
      <div class="col-75">
        <input type="text" id="fname" name="firstname" placeholder="Child name..">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="lname">Father's Name</label>
      </div>
      <div class="col-75">
        <input type="text" id="lname" name="lastname" placeholder="father's name..">
      </div>
    </div>
     <div class="row">
      <div class="col-25">
        <label for="lname">Father's Phone Number</label>
      </div>
      <div class="col-75">
        <input type="text" id="lname" name="lastname" placeholder="">
      </div>
    </div>
     <div class="row">
      <div class="col-25">
        <label for="lname">Father's Email ID</label>
      </div>
      <div class="col-75">
        <input type="text" id="lname" name="lastname" placeholder="">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="lname">Mother's Name</label>
      </div>
      <div class="col-75">
        <input type="text" id="lname" name="lastname" placeholder="mother's name..">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="lname">Mother's Phone Number</label>
      </div>
      <div class="col-75">
        <input type="text" id="lname" name="lastname" placeholder="">
      </div>
    </div>
     <div class="row">
      <div class="col-25">
        <label for="lname">Mother's Email ID</label>
      </div>
      <div class="col-75">
        <input type="text" id="lname" name="lastname" placeholder="">
      </div>
    </div>
   
    
    <div class="row">
      <div class="col-25">
        <label for="lname">Age</label>
      </div>
      <div class="col-75">
        <input type="text" id="lname" name="lastname" placeholder="">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="country">Gender</label>
      </div>
      <div class="col-75">
        <select id="country" name="country">
          <option value="australia">Male</option>
          <option value="canada">Female</option>
          <option value="usa">Others</option>
        </select>
      </div>
    </div>
    
     
    <div class="row">
      <div class="col-25">
        <label for="subject">Hobby</label>
      </div>
      <div class="col-75">
        <textarea id="subject" name="subject" placeholder="if any.." style="height:100px"></textarea>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="subject">Repeatative Behaviour</label>
      </div>
      <div class="col-75">
        <textarea id="subject" name="subject" placeholder="if any.." style="height:100px"></textarea>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="subject">Eating Habit</label>
      </div>
      <div class="col-75">
        <textarea id="subject" name="subject" placeholder="if any.." style="height:100px"></textarea>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="subject">Communication Skill</label>
      </div>
      <div class="col-75">
        <textarea id="subject" name="subject" placeholder="if any.." style="height:100px"></textarea>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="subject">Special Skill</label>
      </div>
      <div class="col-75">
        <textarea id="subject" name="subject" placeholder="if any.." style="height:100px"></textarea>
      </div>
    </div>
    <div class="row">
      <input type="submit" value="Submit">
    </div>
  </form>
</div>

</body>
</html>
