let fb = document.querySelector(".facebook-link");
let gh = document.querySelector(".github-link");
let li = document.querySelector(".linkedin-link");

fb.textContent = facebookk;
fb.href = "https://www.facebook.com/" + facebookk;
gh.textContent = github;
gh.href = "https://www.github.com/" + github;
li.textContent = linkedin;
li.href = "https://www.linkedin.com/in/" + linkedin;

let adminname = document.querySelector(".uproname");
let adminemail = document.querySelector(".uproemail");
let adminlocation = document.querySelector(".uprolocation");

adminname.textContent = name;
adminemail.textContent = email;
adminlocation.textContent = locationn;
