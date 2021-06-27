let response = [];
let thread_list = document.querySelector('#thread-list');

window.onload = function() {
    callAPI();
};

async function callAPI()
{
    await fetch('http://forum-php-api.test/threads')
        .then(response => response.json())
        .then(data => {
            response = data.data;

            showThreads();
        })
        .catch(error => console.log(error));
}

/* showThreads()
 * -------------
 * Laat alle threads uit de database zien in een tabel op de pagina
 *
 */
function showThreads()
{
    response.forEach(thread => {
        thread_list.innerHTML += `
            <tr>
                <th scope="row" class="text-center">${thread.id}</th>
                <td>${thread.title}</td>
                <td>${thread.description}</td>
                <td class="text-center">${thread.user_id}</td>
                <td class="text-center">${thread.created_at}</td>
                <td class="text-center">${thread.updated_at}</td>
                <td class="text-center">
                    <button class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></button>
                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                </td>
            </tr>
        `;
    })
}