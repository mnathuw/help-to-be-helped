function displayData(response,searchTaskValue)
{
    console.log("Length: " + response.length);
    tbody = document.getElementsByTagName('tbody')[0];

    // Clear old data
    while (tbody.firstChild) {
        tbody.removeChild(tbody.firstChild);
    }

    table = document.getElementById('tblData');
    notice = document.getElementById('notice');
    result = document.getElementById('result');

    if(response.length === 0){
        result.classList.add('d-none');
        table.classList.add('d-none');
        notice.classList.remove('d-none');
        notice.innerHTML= 'Could not find any available tasks that includes \'' + searchTaskValue + '\'';
        return;
    }

    result.classList.remove('d-none');
    result.innerHTML = 'The ' + response.length + ' task with a task name that includes \'' + searchTaskValue + '\'';
    table.classList.remove('d-none');
    notice.classList.add('d-none');



    for(let i=0; i<response.length; i++){
       
        let tr = document.createElement("tr");

        let td_Title = document.createElement("td");
        let td_Description = document.createElement("td");
        let td_DatePosted = document.createElement("td");

        td_Title.innerHTML = response[i]['task_type'];
        td_Description.innerHTML = response[i]['task_description'];
        td_DatePosted.innerHTML = response[i]['DatePosted'];
        
        tr.appendChild(td_Title);
        tr.appendChild(td_Description);
        tr.appendChild(td_DatePosted);
        tbody.appendChild(tr);
    }
}

/*
* This function query Open Data when user click to search button
*/
function queryTasksByName(event) {
    
    // Fetch the task provided by the user in the target input.
    let searchTaskValue = document.getElementById("task").value.trim();
   
    // Don't do anything if District input is blank
    if (searchTaskValue === '') {
      return;
    }

    let apiUrl = 'csvjson.json?' +
                    `$where=lower(task_type) LIKE lower('%${searchTaskValue}%')` +
                    '&$order=task_code DESC' +
                    '&$limit=100';

    let encodedURL = encodeURI(apiUrl);
    
    fetch(encodedURL)
    .then(function(rawResponse) { 
        return rawResponse.json(); // Promise for parsed JSON.
    })
    .then(function(response) {
        displayData(response,searchTaskValue); 
    });

    // Prevent submit
    event.preventDefault();
}

/*
* This function call query when user click on the samples in the form
*/
function sampleQuery(event)
{
    document.getElementById("task").value = event.target.innerHTML.trim();
    queryTasksByName(event);
}

// Bind the queryTasksByName function to the submit event of Search button.
function bindEventListeners() {
    const queryName = document.querySelector('form');
    counselling = document.querySelector('a[href="#counselling"]');
    haircuts = document.querySelector('a[href="#haircuts"]');

    queryName.addEventListener("submit", queryTasksByName);

    counselling.addEventListener('click',sampleQuery);
    haircuts.addEventListener('click',sampleQuery);
}

// The only function invoked when the HTML document loads.
document.addEventListener('DOMContentLoaded', bindEventListeners);