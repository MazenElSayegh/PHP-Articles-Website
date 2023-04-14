let groupSearchInput = document.querySelector(".groupSearchInput");

document.addEventListener("click", function (e) {
  if (e.target.classList.contains("deleteBtn")) {
    if (confirm("Are you sure you want to delete this group?")) {
      let groupID =
        e.target.parentElement.parentElement.querySelector(
          ".groupID"
        ).innerText;
      let xhttp = new XMLHttpRequest();
      const formData = new FormData();
      formData.append("groupID", groupID);
      xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          e.target.parentElement.parentElement.remove();
        }
      };
      xhttp.open("POST", "./deleteGroup.php", true);
      xhttp.send(formData);
    }
  }
}); // Delete

document.addEventListener("click", function (e) {
  if (e.target.classList.contains("updateBtn")) {
    let groupID = e.target.parentElement.querySelector(".groupIDInput").value;
    let groupIcon =
      e.target.parentElement.querySelector(".groupIconInput").value;
    let groupName =
      e.target.parentElement.querySelector(".groupNameInput").value;
    let groupDescription = e.target.parentElement.querySelector(
      ".groupDescriptionInput"
    ).value;
    let xhttp = new XMLHttpRequest();
    const formData = new FormData();
    formData.append("groupID", groupID);
    formData.append("groupIcon", groupIcon);
    formData.append("groupName", groupName);
    formData.append("groupDescription", groupDescription);
    xhttp.open("POST", "./updateGroup.php", true);
    xhttp.send(formData);
  }
}); // Update

document.addEventListener("click", function (e) {
  if (e.target.classList.contains("editBtn")) {
    let parent = e.target.parentElement.parentElement;
    let id = parent.querySelector(".groupID").innerText;
    let icon = parent.querySelector(".groupIcon i").classList[1];
    let name = parent.querySelector(".groupName").innerText;
    let description = parent.querySelector(".groupDescription").innerText;

    let form = document.querySelector("form");
    form.querySelector(".groupIDInput").value = id;
    form.querySelector(".groupIconInput").value = icon;
    form.querySelector(".groupNameInput").value = name;
    form.querySelector(".groupDescriptionInput").value = description;
  }
}); // Edit Button

groupSearchInput.addEventListener("input", function (e) {
  let groupTableBody = document.querySelector(".groupTableBody");
  let xhttp = new XMLHttpRequest();
  const formData = new FormData();
  formData.append("searchTerm", this.value);
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let response = xhttp.responseText;
      groupTableBody.innerHTML = "";
      if (xhttp.responseText != "not found") {
        let responsesArr = JSON.parse(response);
        console.log(responsesArr);
        responsesArr.forEach((response) => {
          groupTableBody.innerHTML += `
          <tr>
          <th scope="row" class="groupID">${response.id}</th>
          <td class="groupIcon">' . <i class="fa ${response.icon}" aria-hidden="true"></i></td>
          <td class="groupName">${response.name}</td>
          <td class="groupDescription">${response.description}</td>
          <td>
                <button type="button" class="btn btn-primary editBtn">Edit</button>
                <button type="button" class="btn btn-danger deleteBtn">Delete</button>
              </td>
        </tr>
          `;
        });
      } else {
        groupTableBody.innerHTML += `
        <tr>
        <th scope="row" rowspan='5'>NOT FOUND</th>
      </tr>
      `;
      }
    }
  };
  xhttp.open("POST", "./searchGroup.php", true);
  xhttp.send(formData);
});
