window.onload = function() {
    callAPI();
};

async function callAPI()
{
    await fetch('http://forum-api-2021.test')
        .then(response => response.json())
        .then(data => {
            console.log(data);
        })
        .catch(error => console.log(error));
}