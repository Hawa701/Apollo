const applyJob = document.getElementById("apply-job");
const filterIcon = document.getElementById("filter");
const jobContainer = document.getElementById("job-container");
const applyJobInfo = document.getElementById("all-job-information");
const jobs = document.getElementById("jobs");

const jobArray = [
  {
    index: 0,
    jobId: 1,
    title: "Woocommerce Custom Checkout",
    payment: 5000,
    experience: "Intermediate",
    date: "4/19/2023",
    description:
      "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quas, ex ut. Minima natus blanditiis incidunt animi, assumenda repudiandae facere debitis a distinctio voluptate quibusdamodio itaque eveniet similique cupiditate magni! Provident expedita, nemo ad possimus, quod incidunt vel fugit nobis earum repellendus nulla ullam necessitatibus fuga voluptates laborum dolorem, vitae quasi delectus facere molestias maxime minus beatae perspiciatis est. Blanditiis quia rerum nemo repudiandae aut ea et porro, excepturi soluta?",
    proposals: "Less than 5",
    token: "6",
  },
  {
    index: 1,
    jobId: 2,
    title: "Marketing Coordinator",
    payment: 10000,
    experience: "Expert",
    date: "4/19/2023",
    description:
      "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quas, ex ut. Minima natus blanditiis incidunt animi, assumenda repudiandae facere debitis a distinctio voluptate quibusdamodio itaque eveniet similique cupiditate magni! Provident expedita, nemo ad possimus, quod incidunt vel fugit nobis earum repellendus nulla ullam necessitatibus fuga voluptates laborum dolorem, vitae quasi delectus facere molestias maxime minus beatae perspiciatis est. Blanditiis quia rerum nemo repudiandae aut ea et porro, excepturi soluta?",
    proposals: "5 to 10",
    token: "6",
  },
  {
    index: 2,
    jobId: 3,
    title: "Web Designer",
    payment: 15000,
    experience: "Enrty Level",
    date: "4/19/2023",
    description:
      "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quas, ex ut. Minima natus blanditiis incidunt animi, assumenda repudiandae facere debitis a distinctio voluptate quibusdamodio itaque eveniet similique cupiditate magni! Provident expedita, nemo ad possimus, quod incidunt vel fugit nobis earum repellendus nulla ullam necessitatibus fuga voluptates laborum dolorem, vitae quasi delectus facere molestias maxime minus beatae perspiciatis est. Blanditiis quia rerum nemo repudiandae aut ea et porro, excepturi soluta?",
    proposals: "10 to 15",
    token: "6",
  },
  {
    index: 3,
    jobId: 4,
    title: "Project Manager",
    payment: 20000,
    experience: "Intermediate",
    date: "4/19/2023",
    description:
      "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quas, ex ut. Minima natus blanditiis incidunt animi, assumenda repudiandae facere debitis a distinctio voluptate quibusdamodio itaque eveniet similique cupiditate magni! Provident expedita, nemo ad possimus, quod incidunt vel fugit nobis earum repellendus nulla ullam necessitatibus fuga voluptates laborum dolorem, vitae quasi delectus facere molestias maxime minus beatae perspiciatis est. Blanditiis quia rerum nemo repudiandae aut ea et porro, excepturi soluta?",
    proposals: "15+",
    token: "6",
  },
];

//loading the jobs in the container
const jobLoader = () => {
  jobContainer.innerHTML = "";

  for (var i = 0; i < jobArray.length; i++) {
    jobContainer.innerHTML += `<div class="jobs" id="${jobArray[i].id}">
              <div class="title-block">
                <h3 onclick="openApplyJob('68%', ${jobArray[i].index})">
                  ${jobArray[i].title}
                </h3>
                <div class="bookmark" onclick="saveJobIcon('bookmark-icon')">
                  <i class="fa-regular fa-bookmark" id="bookmark-icon"></i>
                </div>
              </div>

              <div class="job-info">
                <span>
                  Payment:
                  <span>${jobArray[i].payment}ETB</span>
                  - <span>${jobArray[i].experience}</span>
                  - Est. Time:
                  <span>2 to 5 months</span>
                  - Posted -
                  <span>${jobArray[i].date}</span>
                </span>
              </div>

              <div class="description" onclick="openApplyJob('68%', ${jobArray[i].index})">
                <p>
                  ${jobArray[i].description}
                </p>
              </div>

              <div id="tags">
                <span class="tag">PHP</span>
                <span class="tag">JS</span>
                <span class="tag">HTML</span>
                <span class="tag">CSS</span>
              </div>

              <div class="apply-info">
                <div class="text">Proposals: <span>${jobArray[i].proposals}</span></div>
                <div class="text">Number of tokens: <span>${jobArray[i].token}</span></div>
              </div>

              <hr />
            </div>`;
  }
};

jobLoader();

//loading the apply job values
const applyJobInfoLoader = (index) => {
  applyJobInfo.innerHTML = "";
  applyJobInfo.innerHTML = `<div class="info one">
              <h3>${jobArray[index].title}</h3>
              <h4>Front-End Development</h4>
              <p>${jobArray[index].date}</p>
            </div>
            <div class="info two">
              <p>${jobArray[index].description}</p>
              <br />
              <a href="#">https://dummy.link</a><br />
              <a href="#">https://dummy.link</a><br />
              <a href="#">https://dummy.link</a>
            </div>
            <div class="info three">
              <button id="ap-btn" class="btn apply">Apply Now</button>
              <button
                id="sv-btn"
                class="btn save"
                onclick="saveJobBtn('sv-btn')"
              >
                Save Job
              </button>
            </div>
            <div class="info four">
              <div class="box price">
                <h4>$${jobArray[index].payment}</h4>
                <span>Fixed Price</span>
              </div>
              <div class="box ex-level">
                <h4>${jobArray[index].experience}</h4>
                <span
                  >Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                  Fuga, maxime.</span
                >
              </div>
            </div>
            <div class="info five">
              <h4>Project type</h4>
              <span>One time project</span>
            </div>
            <div class="info six">
              <h4>About the client</h4>
              <p>Posted Jobs: <span>8</span></p>
            </div>
            <div class="info seven">
              <h4>Skills and Expertise</h4>
              <div id="tags">
                <span class="tag">PHP</span>
                <span class="tag">JS</span>
                <span class="tag">HTML</span>
                <span class="tag">CSS</span>
              </div>
            </div>
            <div class="info eight">
              <h4>Job link</h4>
            </div>
            <div class="info nine">
              <h4>Activity on this job</h4>
              <p>Proposals: <span>${jobArray[index].proposals}</span></p>
              <p>Interviews: <span>10</span></p>
            </div>`;
};

//toggling the apply job page

function openApplyJob(wid, id) {
  applyJobInfoLoader(id);
  applyJob.style.width = wid;
  applyJob.style.left = "unset";
}

function closeApplyJob() {
  applyJob.style.left = "100%";
  applyJob.style.width = "0%";
}

//toggling the filter btn
function toggleFilter(iconID) {
  if (document.getElementById(iconID).className == "fa-solid fa-filter") {
    document.getElementById(iconID).className = "fa-solid fa-square-minus";
    filterIcon.style.display = "inline-block";
  } else {
    document.getElementById(iconID).className = "fa-solid fa-filter";
    filterIcon.style.display = "none";
  }
}

//saving a job (icon)
function saveJobIcon(iconID) {
  if (document.getElementById(iconID).className == "fa-regular fa-bookmark") {
    document.getElementById(iconID).className = "fa-solid fa-bookmark";
    document.getElementById(iconID).style.color = "var(--main-color)";
  } else {
    document.getElementById(iconID).className = "fa-regular fa-bookmark";
    document.getElementById(iconID).style.color = "var(--main-text-color)";
  }
}

//saving a job (in apply page)
function saveJobBtn(btnID) {
  if (document.getElementById(btnID).innerText == "Save Job") {
    document.getElementById(btnID).innerText = "Job Saved";
  } else {
    document.getElementById(btnID).innerText = "Save Job";
  }
}

//Clearing the filter section
function clear() {
  //document.getElementsById("level") ... = "checked";
}
